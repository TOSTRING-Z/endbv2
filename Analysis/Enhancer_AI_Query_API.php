<?php
/**
 * ENdb AI Query API
 * 基于 DeepSeek 的智能查询 — 将自然语言转为 SQL 查询 enhancer_main 表
 */
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);
while (ob_get_level()) { ob_end_clean(); }

require_once '../public/conn.php';

// === 需要反引号包裹的 MySQL 保留字 / 特殊列名 ===
$RESERVED_COLUMNS = ['Condition', 'Start_position', 'End_position'];

// === Database wrapper ===
class ENdbDB {
    private $conn;
    public function __construct() { $this->conn = $GLOBALS['conn']; }
    public function query($sql) {
        global $RESERVED_COLUMNS;
        if (stripos(trim($sql), 'SELECT') !== 0) {
            return ['error' => 'Only SELECT queries are allowed'];
        }
        // 自动为 MySQL 保留字 / 特殊列名添加反引号
        foreach ($RESERVED_COLUMNS as $col) {
            // 只替换未被反引号包裹的裸列名（避免重复包裹）
            $sql = preg_replace('/(?<!`)' . preg_quote($col, '/') . '(?!`)/i', '`$0`', $sql);
        }
        $result = mysqli_query($this->conn, $sql);
        if (!$result) return ['error' => mysqli_error($this->conn)];
        $rows = []; $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($row as $k => $v) { if ($v === null) $row[$k] = ''; }
            $rows[] = $row;
            if (++$count >= 100) break;
        }
        return $rows;
    }
}

// === DeepSeek 调用（使用 file_get_contents，兼容性好） ===
function callDeepSeek($prompt) {
    $apiKey = getenv('DEEPSEEK_API_KEY');
    if (!$apiKey) {
        return ['type' => 'error', 'message' => 'DEEPSEEK_API_KEY is not configured'];
    }
    $data = [
        'model' => 'deepseek-chat',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a bioinformatics database assistant. You ONLY return valid JSON.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'temperature' => 0.1,
        'max_tokens' => 500
    ];

    $opts = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
            'content' => json_encode($data),
            'timeout' => 30,
            'ignore_errors' => true
        ]
    ];
    $ctx = stream_context_create($opts);
    $resp = @file_get_contents('https://api.deepseek.com/chat/completions', false, $ctx);

    if ($resp === false) {
        return ['type' => 'error', 'message' => 'API connection failed. Please check network or try again later.'];
    }

    $result = json_decode($resp, true);
    if (!$result || isset($result['error'])) {
        return ['type' => 'error', 'message' => 'API error: ' . ($result['error']['message'] ?? 'Unknown')];
    }
    $content = $result['choices'][0]['message']['content'] ?? '';
    if (preg_match('/\{.*\}/s', $content, $m)) {
        $parsed = json_decode($m[0], true);
        if ($parsed) return $parsed;
    }
    return ['type' => 'error', 'message' => 'Failed to parse response'];
}

// === 可用字段映射（严格匹配数据库 enhancer_main 真实列名） ===
$availableFields = [
    'Enhancer_id', 'Year', 'PMID', 'Title', 'Species', 'Genome_Build',
    'Chromosome', 'Start_position', 'End_position', 'TF', 'Target_Gene',
    'Enhancer_type', 'Regulatory_State', 'Condition', 'Disease_Name',
    'MONDO', 'Tissue', 'Tissue_Ontology_ID',
    'Cell_Source', 'CVCL_ID', 'Cell_Type', 'Cell_Ontology_ID',
    'Experiment_Type', 'High_Throughput_Method', 'Low_Throughput_Method'
];

// === 已知的枚举值（帮助 AI 生成更准确的 SQL） ===
$knownValues = [
    'Species' => ['human' => ['Homo sapiens', 'human'], 'mouse' => ['Mus musculus', 'mouse']],
    'Enhancer_type' => ['Enhancer', 'Super-enhancer'],
    'Regulatory_State' => ['Active', 'Silenced'],
    'Condition' => ['Disease', 'Normal'],
    'Experiment_Type' => ['Enhancer activity assay', 'TF binding assay', 'Chromatin interaction assay', 'Functional perturbation assay']
];

// === 启动 ===
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['error' => 'Only POST method is supported']);
        exit;
    }

    $query = $_POST['query'] ?? '';
    $rowLimit = min((int)($_POST['rowLimit'] ?? 50), 100);
    if (empty(trim($query))) {
        echo json_encode(['error' => 'Query cannot be empty']);
        exit;
    }

    // 构造 Prompt
    $fieldsStr = implode(', ', $availableFields);
    $knowStr = json_encode($knownValues, JSON_UNESCAPED_UNICODE);

    $prompt = <<<EOT
You are a bioinformatics database assistant for ENdb, a database of experimentally validated enhancers.

Database: `enhancer_main` table with columns: $fieldsStr

Known possible values in the database: $knowStr

User query: "$query"

Rules:
1. Generate ONLY a SQL SELECT query against `enhancer_main` table.
2. Use LIKE for fuzzy matching of tissue/cell/disease names (e.g., `Tissue` LIKE '%lung%').
3. For Species, match: human → "Homo sapiens", mouse → "Mus musculus" (use `Species` LIKE '%Homo sapiens%' or `Species` LIKE '%Mus musculus%').
4. Limit results to $rowLimit rows.
5. Only SELECT allowed - no INSERT/UPDATE/DELETE/DROP.
6. Return ONLY JSON: {"type":"query","sql":"SELECT ... FROM enhancer_main WHERE ... LIMIT $rowLimit"}
7. CRITICAL: ALWAYS wrap column names in backticks (e.g., \`Condition\`, \`Start_position\`, \`End_position\`). NEVER use bare column names.

Example queries:
- "enhancers in lung tissue" → SELECT * FROM enhancer_main WHERE \`Tissue\` LIKE '%lung%' LIMIT $rowLimit
- "super enhancers in liver" → SELECT * FROM enhancer_main WHERE \`Enhancer_type\` LIKE '%super%' AND \`Tissue\` LIKE '%liver%' LIMIT $rowLimit
- "B cell enhancers" → SELECT * FROM enhancer_main WHERE \`Cell_Source\` LIKE '%B cell%' LIMIT $rowLimit
- "enhancers related to gastric cancer" → SELECT * FROM enhancer_main WHERE \`Disease_Name\` LIKE '%gastric cancer%' LIMIT $rowLimit
- "human enhancers with TF CTCF" → SELECT * FROM enhancer_main WHERE \`Species\` LIKE '%Homo sapiens%' AND \`TF\` LIKE '%CTCF%' LIMIT $rowLimit
- "enhancers in brain tissue related to disease" → SELECT * FROM enhancer_main WHERE \`Tissue\` LIKE '%brain%' AND \`Condition\` = 'Disease' LIMIT $rowLimit

Return ONLY JSON with type and sql fields. No markdown, no explanation.
EOT;

    $action = callDeepSeek($prompt);

    if ($action['type'] === 'error') {
        echo json_encode(['error' => $action['message']]);
        exit;
    }

    if ($action['type'] !== 'query' || empty($action['sql'])) {
        echo json_encode(['error' => 'Could not understand your query. Please try rephrasing (e.g., "enhancers in lung tissue", "super enhancers in liver").']);
        exit;
    }

    $db = new ENdbDB();
    $results = $db->query($action['sql']);

    if (isset($results['error'])) {
        echo json_encode(['error' => 'SQL Error: ' . $results['error'] . ' | SQL: ' . $action['sql']]);
        exit;
    }

    // 构建与 Browse 页面一致的输出列，并附加 detail 链接
    $browseData = [];
    foreach ($results as $r) {
        $species = $r['Species'] ?? '';
        $enhancerId = $r['Enhancer_id'] ?? '';
        $browseData[] = [
            'Enhancer ID'     => $enhancerId,
            'Genome Location' => ($r['Chromosome'] ?? '') . ':' . ($r['Start_position'] ?? '') . '~' . ($r['End_position'] ?? ''),
            'Tissue'          => $r['Tissue'] ?? '',
            'Cell Source'     => $r['Cell_Source'] ?? '',
            'Disease'         => $r['Disease_Name'] ?? '',
            'Experiment Type' => $r['Experiment_Type'] ?? '',
            '_Species'        => $species,
            '_Enhancer_id'    => $enhancerId
        ];
    }

    echo json_encode([
        'data' => $browseData,
        'count' => count($browseData),
        'sql' => $action['sql'],
        'query' => $query
    ]);

} catch (Exception $e) {
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
