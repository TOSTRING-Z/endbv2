<!DOCTYPE html>
<html>

<head>
    <title>ENdb-Search-Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <?php include "../public/import.php" ?>
    <style>
        .inter-line {
            position: absolute;
            text-align: center;
            width: 100%;
            top: 23px;
            color: #0b0b0b;
            font-size: 14px;
        }

        .inter-line span {
            position: relative;
            right: 5px;
            height: 4px;
            width: 20px;
            color: orange;
            top: -3px;
            display: inline-block;
            background: orange;
        }
        /* ===== Hero Banner ===== */
        .page-hero {
            background: linear-gradient(135deg, #1a3c34 0%, #2d6b5f 40%, #418679 100%);
            padding: 2rem 0 1.6rem;
            margin-bottom: 1.8rem;
            position: relative;
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .page-hero .container { position: relative; z-index: 1; }
        .page-hero .breadcrumb-bg {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }
        .page-hero .breadcrumb-bg a { color: rgba(255,255,255,0.85); }
        .page-hero .breadcrumb-bg a:hover { color: #fff; }
        .page-hero .hero-title {
            color: #fff;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.2rem;
        }
        .page-hero .hero-title .highlight { color: #ffc65e; }
        .page-hero .hero-subtitle {
            color: rgba(255,255,255,0.75);
            font-size: 0.9rem;
        }

        /* ===== Detail Cards ===== */
        .detail-section {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        .detail-section .section-header {
            background: linear-gradient(135deg, #f0f7f5, #e8f2ef);
            padding: 0.9rem 1.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: #32325d;
            border-bottom: 1px solid #dde8e4;
        }
        .detail-section .section-header i { color: #418679; margin-right: 0.5rem; }
        .detail-section .section-body { padding: 1.2rem 1.5rem; }

        .detail-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .detail-table td {
            padding: 0.6rem 1rem;
            border-bottom: 1px solid #f1f3f5;
            vertical-align: middle;
            font-size: 0.9rem;
            color: #525f7f;
        }
        .detail-table td:first-child {
            white-space: nowrap;
            font-weight: 600;
            color: #32325d;
            width: 220px;
            background: #fafcfb;
        }
        .detail-table td a { color: #418679; font-weight: 600; }

        hr.detail-sep {
            border: none;
            height: 1px;
            background: linear-gradient(to right, #e0e8e5, transparent);
            margin: 1.5rem 0;
        }

        .inter-line {
            text-align: center;
            color: #8898aa;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            font-style: italic;
        }
        .inter-line span { color: #ffc65e; font-weight: 700; }

        @media (max-width: 991px) {
            .page-hero { padding: 1.3rem 0 1rem; }
            .page-hero .hero-title { font-size: 1.3rem; }
            .detail-table td:first-child { width: 140px; }
        }
    </style>
</head>

<body>
<?php include "../public/header.php" ?>

<!-- ===== Hero Banner ===== -->
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <a href="/ENdb/Search.php">Search</a> &nbsp;/&nbsp; <span>Detail</span>
        </div>
        <h1 class="hero-title">Enhancer <span class="highlight">Detail</span></h1>
        <p class="hero-subtitle">Comprehensive information about experimentally validated enhancers</p>
    </div>
</div>

<?php
include '../public/conn.php';
$Species = $_GET["Species"] ?? '';
$Enhancer_id = $_GET["Enhancer_id"] ?? '';
$sql = "SELECT * FROM enhancer_main where  Enhancer_id='" . $Enhancer_id . "'";

$enhancer_res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($enhancer_res)) {
    $Enhancer_id = $row["Enhancer_id"] ?? '';
    $Year = $row["Year"] ?? '';
    $PMID = $row["PMID"] ?? '';
    $Title = $row["Title"] ?? '';
    $Genome_Build = $row["Genome_Build"] ?? '';
    $Chromosome = $row["Chromosome"];
    $Start_position = $row["Start_position"];
    $End_position = $row["End_position"];
    $Species = $row["Species"];
    switch (strtolower($Species)) {
        case "human":
        case "homo sapiens":
            $ref = "hg38";
            $snp_track = "";  // SNP data not available
            break;
        case "mouse":
        case "mus musculus":
            $ref = "mm39";
            $snp_track = "";  // SNP data not available
            break;
    }
    // Fallback: use species-default genome build when database value is NA or empty
    if ($Genome_Build === 'NA' || empty($Genome_Build)) {
        $Genome_Build = $ref;
    }
    $Enhancer_type = $row["Enhancer_type"] ?? '';
    $Regulatory_State = $row["Regulatory_State"] ?? '';
    $Condition = $row["Condition"] ?? '';
    $Disease_Name = $row["Disease_Name"] ?? '';
    $MONDO = $row["MONDO"] ?? '';
    $Tissue = $row["Tissue"] ?? '';
    // Standard_Name 已移除，使用 Tissue 代替
    $Tissue_Ontology_ID = $row["Tissue_Ontology_ID"] ?? '';
    $Cell_Source = $row["Cell_Source"] ?? '';
    $CVCL_ID = $row["CVCL_ID"] ?? '';
    $Cell_Type = $row["Cell_Type"] ?? '';
    $Cell_Ontology_ID = $row["Cell_Ontology_ID"] ?? '';
    $Experiment_Type = $row["Experiment_Type"] ?? '';
    $High_Throughput_Method = $row["High_Throughput_Method"] ?? '';
    $Low_Throughput_Method = $row["Low_Throughput_Method"] ?? '';

    $Target_Gene = $row["Target_Gene"] ?? '';
    $TF = $row["TF"] ?? '';
}

$enhancer_d3_sql = "SELECT *
                FROM enhancer_main
                where  Enhancer_id='" . $Enhancer_id . "';";

$enhancer_d3_res = mysqli_query($conn, $enhancer_d3_sql);
$ar_enh = array();
$arr_gene = array();
$Enhancer_all = array();
while ($row = mysqli_fetch_assoc($enhancer_d3_res)) {
    $arr_gene = explode(',', $row["Target_Gene"]);
    $TF_arr = explode(',', $row["TF"]);

    $gene = $row["Target_Gene"];
    $gene_arr = explode(',', $row["Target_Gene"]);
    $Regulatory_State_arr = explode(',', $row["Regulatory_State"]);
    $Disease_arr = explode(',', $row["Disease_Name"]);

    $Enhancer["Genes"] = $gene_arr;
    $Enhancer["TFs"] = $TF_arr;
    $Enhancer["Disease"] = $Disease_arr;
    $Enhancer["Regulatory_State"] = $Regulatory_State_arr;
}

$Enhancer_all[$Enhancer_id] = true;

$data["node"][0]["category"] = "Enhancer ID";
$data["node"][0]["id"] = $Enhancer_id;
$data["node"][0]["name"] = $Enhancer_id;
$data["node"][0]["value"] = $Chromosome . ":" . $Start_position . "-" . $End_position;
$data["node"][0]["label"]["normal"]["show"] = true;
$data["node"][0]["label"]["normal"]["fontSize"] = "10";
$i = 1;
$l = 1;
foreach ($Enhancer as $key => $values) {
    foreach ($values as $value) {
        if ($value == "--") {
            continue;
        }
        if ($key != "Regulatory_State") {
            $data["node"][$i]["category"] = $key;
            $data["node"][$i]["id"] = $key . "_" . $value;
            $data["node"][$i]["name"] = strlen($value) > 20 ? str_split($value, 20)[0] . "..." : $value;
            $data["node"][$i]["name_all"] = $value;
            $data["node"][$i]["label"]["normal"]["show"] = true;
            $data["node"][$i]["label"]["normal"]["borderColor"] = "#f0f0f0";
            $data["node"][$i]["label"]["normal"]["fontSize"] = "10";

            $data["links"][$l - 1]["source"] = $Enhancer_id;
            $data["links"][$l - 1]["target"] = $key . "_" . $value;
            $data["links"][$l - 1]["lineStyle"]["normal"]["width"] = 2;
            if ($key == 'Genes') {
                $data["links"][$l - 1]["n_Distance_from_TSS"] = 0;
            }
            $data["links"][$l - 1]["lineStyle"]["normal"]["color"] = ($key == "Genes" ? "orange" : "#ccc");
            $i++;
            $l++;
        } else {
            $data["node"][$i]["category"] = $key;
            $data["node"][$i]["id"] = $key . "_" . $value;
            $data["node"][$i]["name"] = strlen($value) > 7 ? str_split($value, 8)[0] . "..." : $value;
            $data["node"][$i]["name_all"] = $value;
            $data["node"][$i]["label"]["normal"]["show"] = true;
            $data["node"][$i]["label"]["normal"]["borderColor"] = "#f0f0f0";
            $data["node"][$i]["label"]["normal"]["fontSize"] = "10";

            $data["links"][$l - 1]["source"] = $Enhancer_id;
            $data["links"][$l - 1]["target"] = $key . "_" . $value;
            $data["links"][$l - 1]["lineStyle"]["normal"]["width"] = 2;

            $i++;
            $l++;
        }
    }
}
$dataTest = json_encode($data)
?>
<div class="container" style="padding-bottom:2rem;">
    <div class="row">
        <!-- ===== About Enhancer ===== -->
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-info-circle"></i> About Enhancer
                </div>
                <div class="section-body">
            <table class="detail-table">
                <tr>
                    <td style="white-space:nowrap;"><strong>Enhancer ID:</strong></td>
                    <td><?php echo $Enhancer_id; ?></td>
                </tr>
<?php if ($Species !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Species:</strong></td>
                    <td><?php echo $Species; ?></td>
                </tr>
<?php endif; ?>

                <tr>
                    <td style="white-space:nowrap;"><strong>Position</strong> <i data-placement="top"
                                                                                 data-toggle="tooltip"
                                                                                 title="The tracks included the histone modifications data (e.g., H3K27ac, H3K4me1) was browsed in the genome browser. GIVE enable automatic generation of interactive visualization webpages for user chosen chromosome conformation data."
                                                                                 class="fa fa-question-circle"
                                                                                 aria-hidden="true"></i>:
                    </td>
                    <td><?php echo "$Chromosome:$Start_position-$End_position"; ?>
                        <br><?php echo '<a href=\'http://www.licpathway.net/endb_gb/?config=configs%2F'.$Genome_Build.'_config.json&assembly='.$Genome_Build.'&loc='.$Chromosome.':'.$Start_position.'-'.$End_position.'&tracks='.$Genome_Build.'-ReferenceSequenceTrack,gencode_gene_'.$Genome_Build.'.sorted.gff,enhancer_'.$Genome_Build.'.sorted.gff&highlight='.$Chromosome.':'.$Start_position.'-'.$End_position.'&tracklist=true\' target="view_window">'; ?>
                        <img src="../images/endb_2.png" height="25"
                             width="75"></a><?php echo '<a href="http://genome.ucsc.edu/cgi-bin/hgTracks?db='.$Genome_Build.'&lastVirtModeType=default&lastVirtModeExtraState=&virtModeType=default&virtMode=0&nonVirtPosition=&position=' . $Chromosome . '%3A' . $Start_position . '%2D' . $End_position . ' " target="view_window">'; ?>
                        <img src="../images/ucsc.jpg" height="25" width="75"></a></td>

                </tr>
<?php if ($Year !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Year:</strong></td>
                    <td><?php echo $Year; ?></td>
                </tr>
<?php endif; ?>

<?php if ($Title !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Title:</strong></td>
                    <td><?php echo $Title; ?></td>
                </tr>
<?php endif; ?>

<?php if ($Genome_Build !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Genome Build:</strong></td>
                    <td><?php echo $Genome_Build; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Enhancer_type !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Enhancer Type:</strong></td>
                    <td><?php echo $Enhancer_type; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Condition !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Condition:</strong></td>
                    <td><?php echo $Condition; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Disease_Name !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Disease Name:</strong></td>
                    <td><?php $i = 0;
                        echo $Disease_Name ?: '--'; ?> </td>
                </tr>
<?php endif; ?>

                <tr>
                    <td style="white-space:nowrap;"><strong>PMID:</strong></td>
                    <td>&nbsp;<a target='_blank'
                                 href="https://pubmed.ncbi.nlm.nih.gov/<?php echo $PMID; ?>"><?php echo $PMID; ?></a>
                    </td>
                </tr>
                <?php if ($MONDO !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>MONDO:</strong></td>
                    <td><?php echo $MONDO; ?></td>
                </tr>
<?php endif; ?>

<?php if ($Tissue !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Tissue:</strong></td>
                    <td><?php echo $Tissue; ?> </td>
                </tr>
<?php endif; ?>


<?php if ($Tissue_Ontology_ID !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Tissue Ontology ID:</strong></td>
                    <td><?php echo $Tissue_Ontology_ID; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Cell_Source !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Cell Source:</strong></td>
                    <td><?php echo $Cell_Source; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($CVCL_ID !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>CVCL ID:</strong></td>
                    <td><?php echo $CVCL_ID; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Cell_Type !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Cell Type:</strong></td>
                    <td><?php echo $Cell_Type; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Cell_Ontology_ID !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Cell Ontology ID:</strong></td>
                    <td><?php echo $Cell_Ontology_ID; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Experiment_Type !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Experiment Type:</strong></td>
                    <td><?php echo $Experiment_Type; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($High_Throughput_Method !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>High Throughput Method:</strong></td>
                    <td><?php echo $High_Throughput_Method; ?> </td>
                </tr>
<?php endif; ?>

<?php if ($Low_Throughput_Method !== "NA"): ?>
                <tr>
                    <td style="white-space:nowrap;"><strong>Low Throughput Method:</strong></td>
                    <td><?php echo $Low_Throughput_Method; ?> </td>
                </tr>
<?php endif; ?>

            </table>
                </div>
            </div>
        </div>

        <!-- ===== About Target gene ===== -->
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-crosshairs"></i> About Target Gene
                </div>
                <div class="section-body">
            <table class="detail-table">
                <tr>
                    <td style="white-space:nowrap;"><strong>Target gene <i data-placement="top" data-toggle="tooltip"
                                                                           title="Gene symbol(aliases)"
                                                                           class="fa fa-question-circle"
                                                                           aria-hidden="true"></i>:</strong></td>
                    <td style="word-break: break-all">
                        <?php
                        $color = ["#ff7f50", "#87cefa", "#61a0a8", "#d48265", "#FFDE76", "#E43C59", "#c23531", "#2f4554", "#ca8622", "#bda29a", "#6e7074", "#546570", "#4BABDE", "#FFDE76", "#E43C59", "#37A2DA"];
                        $i = 0;
                        foreach ($gene_arr as $key => $value) {
                            if ($value == "--") {
                                echo "--";
                                continue;
                            }
                            if ($i > 0) {
                                echo ",";
                            }
                            echo "<a target='_blank' href='https://www.ncbi.nlm.nih.gov/gene/?term=$value'><font color='{$color[$key]}' style='margin-right: 5px'>$value</font></a>";
                            $i++;
                        } ?> </td>
                </tr>


            </table>
                </div>
            </div>
        </div>

        <!-- ===== About TF ===== -->
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-connectdevelop"></i> About TF
                </div>
                <div class="section-body">
            <table class="detail-table">
                <tr>
                    <td style="white-space:nowrap;"><strong>TF name <i data-placement="top" data-toggle="tooltip"
                                                                       title="TF symbol(aliases)"
                                                                       class="fa fa-question-circle"
                                                                       aria-hidden="true"></i>:</strong></td>
                    <td>
                        <?php
                        $tfs = preg_split("/[,]+/", $TF);
                        foreach ($tfs as $key => $val) {
                            echo "<font color='{$color[$key]}' style='margin-right: 5px'>$val</font>";
                        }
                        ?>
                    </td>
                </tr>

            </table>
                </div>
            </div>
        </div>

        <!-- ===== About Regulatory State ===== -->
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-flash"></i> About Regulatory State
                </div>
                <div class="section-body">
            <table class="detail-table">
                <tr>
                    <td style="white-space:nowrap;"><strong>Regulatory State <i data-placement="top"
                                                                                 data-toggle="tooltip"
                                                                                 title="The in-text function was experimentally confirmed and extracted from publibations."
                                                                                 class="fa fa-question-circle"
                                                                                 aria-hidden="true"></i>:</strong></td>
                    <td style="text-align: justify"><?php echo $Regulatory_State; ?> </td>
                </tr>

            </table>
                </div>
            </div>
        </div>

        <!-- ===== Upstream Pathway Annotation ===== -->
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-sitemap"></i> Upstream Pathway Annotation of TF
                </div>
                <div class="section-body">
            <table id="pathway_table" class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                <tr>
                    <th>GeneName</th>
                    <th>Pathway Name</th>
                    <th>Source</th>
                    <th>Gene Number</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($tfs as $tf_name) {
                    $pathway_sql = "SELECT *
                                          from pathway
                                          where find_in_set('$tf_name',geneset)";
                    $pathway_res = mysqli_query($conn, $pathway_sql);
                    while ($row = mysqli_fetch_assoc($pathway_res)) {
                        $pathway_ID = $row["pathway_ID"];
                        $pathway_name = $row["pathway_name"];
                        $pathway_source = $row["pathway_source"];
                        $gene_number = $row["gene_number"];
                        ?>
                        <tr>
                            <td><?php echo $tf_name; ?></td>
                            <td><?php echo $pathway_name; ?></td>
                            <td><?php echo $pathway_source; ?></td>
                            <td><?php echo $gene_number; ?></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
                </div>
            </div>
        </div>

        <!-- ===== Enhancer Associated Network ===== -->
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-share-alt"></i> Enhancer Associated Network
                </div>
                <div class="section-body">
                        <div id="interactions" style="width:100%;height:620px"></div>
                </div>
            </div>
        </div>

        <!-- ===== Overlapping Enhancers ===== -->
        <?php
        // Find enhancers overlapping with current enhancer (same genome build & chromosome, coordinate overlap)
        $overlap_sql = "SELECT Enhancer_id, Chromosome, Start_position, End_position,
                               Tissue, Cell_Source, Cell_Type, Disease_Name, Enhancer_type, Regulatory_State, TF
                        FROM enhancer_main
                        WHERE Genome_Build='$Genome_Build'
                        AND Chromosome='$Chromosome'
                        AND Start_position <= $End_position
                        AND End_position >= $Start_position
                        AND Enhancer_id != '$Enhancer_id'
                        ORDER BY Start_position
                        LIMIT 80";
        $overlap_res = mysqli_query($conn, $overlap_sql);
        $overlap_rows = [];
        $overlap_tissues = [];
        $overlap_cells = [];
        $overlap_diseases = [];
        while ($orow = mysqli_fetch_assoc($overlap_res)) {
            $overlap_rows[] = $orow;
            // Collect unique tissue values
            $tissue_raw = trim($orow['Tissue'] ?? '');
            if ($tissue_raw !== '' && $tissue_raw !== '--' && $tissue_raw !== 'NA') {
                $parts = preg_split('/\s*[,;]\s*/', $tissue_raw);
                foreach ($parts as $p) {
                    $p = trim($p);
                    if ($p !== '') $overlap_tissues[$p] = true;
                }
            }
            // Collect unique cell values
            $cell_raw = trim(($orow['Cell_Type'] ?? '') ?: ($orow['Cell_Source'] ?? ''));
            if ($cell_raw !== '' && $cell_raw !== '--' && $cell_raw !== 'NA') {
                $parts = preg_split('/\s*[,;]\s*/', $cell_raw);
                foreach ($parts as $p) {
                    $p = trim($p);
                    if ($p !== '') $overlap_cells[$p] = true;
                }
            }
            // Collect unique disease values
            $dis_raw = trim($orow['Disease_Name'] ?? '');
            if ($dis_raw !== '' && $dis_raw !== '--' && $dis_raw !== 'NA') {
                $parts = preg_split('/\s*[,;]\s*/', $dis_raw);
                foreach ($parts as $p) {
                    $p = trim($p);
                    if ($p !== '') $overlap_diseases[$p] = true;
                }
            }
        }
        $overlap_count = count($overlap_rows);

        // Build network data for ECharts
        $onodes = [];
        $olinks = [];
        $oidx = 0;
        // Center node: current enhancer
        $onodes[] = ['id' => 'center', 'category' => 'Current Enhancer', 'name' => $Enhancer_id, 'symbolSize' => 55, 'symbol' => 'diamond'];
        $oidx = 1;

        // Tissue category nodes
        $oCatTissues = [];
        foreach ($overlap_tissues as $t => $_) {
            $nid = 'tissue_' . md5($t);
            if (!isset($oCatTissues[$t])) {
                $onodes[] = ['id' => $nid, 'category' => 'Tissue', 'name' => $t, 'symbolSize' => 18, 'symbol' => 'circle'];
                $oCatTissues[$t] = $nid;
                $oidx++;
            }
        }

        // Cell category nodes
        $oCatCells = [];
        foreach ($overlap_cells as $c => $_) {
            $nid = 'cell_' . md5($c);
            if (!isset($oCatCells[$c])) {
                $onodes[] = ['id' => $nid, 'category' => 'Cell', 'name' => $c, 'symbolSize' => 16, 'symbol' => 'roundRect'];
                $oCatCells[$c] = $nid;
                $oidx++;
            }
        }

        // Disease category nodes
        $oCatDiseases = [];
        foreach ($overlap_diseases as $d => $_) {
            $nid = 'disease_' . md5($d);
            if (!isset($oCatDiseases[$d])) {
                $onodes[] = ['id' => $nid, 'category' => 'Disease', 'name' => $d, 'symbolSize' => 20, 'symbol' => 'triangle'];
                $oCatDiseases[$d] = $nid;
                $oidx++;
            }
        }

        // Overlapping enhancer nodes + links to center, tissue, cell, disease
        foreach ($overlap_rows as $orow) {
            $eid = $orow['Enhancer_id'];
            $enid = 'enh_' . $eid;
            // Only add if not already present
            $already = false;
            foreach ($onodes as $n) { if ($n['id'] === $enid) { $already = true; break; } }
            if (!$already) {
                $onodes[] = ['id' => $enid, 'category' => 'Overlapping Enhancer', 'name' => $eid, 'symbolSize' => 28, 'symbol' => 'diamond'];
            }
            // Link: center -> overlapping enhancer
            $olinks[] = ['source' => 'center', 'target' => $enid];

            // Link overlapping enhancer -> its tissues
            $traw = trim($orow['Tissue'] ?? '');
            if ($traw !== '' && $traw !== '--' && $traw !== 'NA') {
                foreach (preg_split('/\s*[,;]\s*/', $traw) as $tp) {
                    $tp = trim($tp);
                    if ($tp !== '' && isset($oCatTissues[$tp])) {
                        $olinks[] = ['source' => $enid, 'target' => $oCatTissues[$tp]];
                    }
                }
            }
            // Link overlapping enhancer -> its cells
            $craw = trim(($orow['Cell_Type'] ?? '') ?: ($orow['Cell_Source'] ?? ''));
            if ($craw !== '' && $craw !== '--' && $craw !== 'NA') {
                foreach (preg_split('/\s*[,;]\s*/', $craw) as $cp) {
                    $cp = trim($cp);
                    if ($cp !== '' && isset($oCatCells[$cp])) {
                        $olinks[] = ['source' => $enid, 'target' => $oCatCells[$cp]];
                    }
                }
            }
            // Link overlapping enhancer -> its diseases
            $draw = trim($orow['Disease_Name'] ?? '');
            if ($draw !== '' && $draw !== '--' && $draw !== 'NA') {
                foreach (preg_split('/\s*[,;]\s*/', $draw) as $dp) {
                    $dp = trim($dp);
                    if ($dp !== '' && isset($oCatDiseases[$dp])) {
                        $olinks[] = ['source' => $enid, 'target' => $oCatDiseases[$dp]];
                    }
                }
            }
        }

        // Deduplicate links
        $olinks_unique = [];
        $seen_links = [];
        foreach ($olinks as $l) {
            $key = $l['source'] . '|||' . $l['target'];
            if (!isset($seen_links[$key])) {
                $seen_links[$key] = true;
                $olinks_unique[] = $l;
            }
        }
        $olinks = $olinks_unique;

        $overlap_net_json = json_encode(['nodes' => $onodes, 'links' => array_values($olinks)], JSON_UNESCAPED_UNICODE);
        ?>
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-object-group"></i> Overlapping Enhancers (<?php echo $Genome_Build; ?>)
                    <?php if ($overlap_count > 0): ?>
                        <span class="badge" style="background:#e74c3c;color:#fff;margin-left:10px;"><?php echo $overlap_count; ?> found</span>
                    <?php endif; ?>
                </div>
                <div class="section-body">
                    <?php if ($overlap_count == 0): ?>
                        <div style="text-align:center;padding:30px;color:#999;">
                            <i class="fa fa-info-circle"></i> No overlapping enhancers found in <?php echo $Genome_Build; ?> at this locus.
                        </div>
                    <?php else: ?>
                    <div class="row">
                        <!-- Left: Table -->
                        <div class="col-lg-7" style="max-height:500px;overflow-y:auto;">
                            <table class="table table-striped table-bordered table-hover" style="font-size:0.85rem;margin:0;">
                                <thead style="background:#1a3c34;color:#fff;position:sticky;top:0;z-index:1;">
                                    <tr>
                                        <th>Enhancer ID</th>
                                        <th>Position</th>
                                        <th>Tissue</th>
                                        <th>Cell</th>
                                        <th>Disease</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($overlap_rows as $orow):
                                        $ov_id = $orow['Enhancer_id'];
                                        $ov_pos = $orow['Chromosome'] . ':' . $orow['Start_position'] . '-' . $orow['End_position'];
                                        $ov_tissue = $orow['Tissue'] ?: '--';
                                        $ov_cell = ($orow['Cell_Type'] ?: $orow['Cell_Source']) ?: '--';
                                        $ov_disease = $orow['Disease_Name'] ?: '--';
                                    ?>
                                    <tr>
                                        <td><a href="Detail.php?Species=<?php echo urlencode($Species); ?>&Enhancer_id=<?php echo $ov_id; ?>" style="color:#2d6b5f;font-weight:600;"><?php echo $ov_id; ?></a></td>
                                        <td style="font-family:monospace;font-size:0.8rem;"><?php echo $ov_pos; ?></td>
                                        <td><?php echo htmlspecialchars($ov_tissue); ?></td>
                                        <td><?php echo htmlspecialchars($ov_cell); ?></td>
                                        <td><?php echo htmlspecialchars($ov_disease); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Right: Network Graph -->
                        <div class="col-lg-5">
                            <div id="overlap_network" style="width:100%;height:500px;"></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ===== Expression & SNPs ===== -->
        <div class="col-lg-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fa fa-bar-chart"></i> Expression of Target Genes for the Enhancer
                </div>
                <div class="section-body">
                    <div id="gene_stat" style="width:100%;height:450px;"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include "../public/footer.php" ?>

<script>
    $(document).ready(function () {
        $('#pathway_table').dataTable({
            dom: '<"row"<"col-lg-12 d-flex justify-content-between align-items-baseline"<iB>f><"col-lg-12 mb-2"rt><"col-lg-12 d-flex justify-content-between align-items-end"lp>>',
            buttons: [{
                extend: 'csvHtml5',
                text: '<i class="fa fa-floppy-o btn btn-default position-relative"></i>'
            }],
            "autoWidth": false,
            "scrollX": true,
            "language": {
                "paginate": {
                    "first": "<<",
                    "previous": "<",
                    "next": ">",
                    "last": ">>"
                }
            }
        });
    });

    var testData = <?php echo $dataTest ?>;
    var interactions = echarts.init(document.getElementById('interactions'));

    // Unique categories with distinct styling
    var catColors = {
        "Enhancer ID": { color: "#e74c3c", size: 50, symbol: "diamond" },
        "Genes":       { color: "#2ecc71", size: 35, symbol: "circle" },
        "TFs":         { color: "#3498db", size: 30, symbol: "roundRect" },
        "Disease":     { color: "#f39c12", size: 25, symbol: "triangle" },
        "Regulatory_State": { color: "#9b59b6", size: 22, symbol: "rect" }
    };

    var categories = Object.keys(catColors).map(function(k) {
        return { name: k, itemStyle: { color: catColors[k].color } };
    });

    // Apply category-based symbol sizes
    var nodes = (testData.node || []).map(function(n) {
        var catStyle = catColors[n.category] || { size: 25, symbol: "circle", color: "#95a5a6" };
        n.symbolSize = catStyle.size;
        n.symbol = catStyle.symbol;
        n.itemStyle = { color: catStyle.color };
        // Restore full name for display
        n.name = n.name_all || n.name;
        return n;
    });

    // Beautify links: only show distance on tooltip
    var edges = (testData.links || []).map(function(e) {
        return e;
    });

    option = {
        color: ["#e74c3c", "#2ecc71", "#3498db", "#f39c12", "#9b59b6", "#1abc9c", "#e67e22", "#34495e"],

        tooltip: {
            backgroundColor: 'rgba(255,255,255,0.95)',
            borderColor: '#ddd',
            borderWidth: 1,
            padding: [10, 14],
            textStyle: { color: '#333', fontSize: 13 },
            formatter: function (obj) {
                if (obj.dataType == 'node') {
                    var cat = obj.data.category || '';
                    var name = obj.data.name_all || obj.data.name || '';
                    var val = obj.data.value || '';
                    var html = '<div style="font-weight:700;font-size:15px;margin-bottom:6px;color:' + (catColors[cat] ? catColors[cat].color : '#333') + '">' +
                        '<span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:' + (catColors[cat] ? catColors[cat].color : '#333') + ';margin-right:8px;"></span>' +
                        cat + '</div>';
                    html += '<div style="font-size:13px;">' + name + '</div>';
                    if (val && cat == "Enhancer ID") {
                        html += '<div style="font-size:12px;color:#888;margin-top:4px;">📍 ' + val + '</div>';
                    }
                    return html;
                } else if (obj.dataType == 'edge') {
                    var dist = obj.data.n_Distance_from_TSS;
                    if (dist) {
                        return '<div style="font-weight:600;font-size:13px;">📏 Distance from TSS</div>' +
                            '<div style="font-size:13px;color:#e74c3c;">' + dist + ' bp</div>';
                    }
                    return '';
                }
                return obj.name;
            }
        },

        legend: [{
            icon: 'circle',
            top: 5,
            left: 'center',
            textStyle: { fontWeight: 600, fontSize: 12, color: '#555' },
            data: categories.map(function (a) { return a.name; })
        }],

        animationDuration: 800,
        animationEasing: 'elasticOut',

        series: [{
            name: 'Enhancer Network',
            type: 'graph',
            layout: 'force',
            data: nodes,
            links: edges,
            categories: categories,
            draggable: true,
            roam: true,
            focusNodeAdjacency: 'allEdges',

            label: {
                show: true,
                position: 'right',
                fontSize: 11,
                fontWeight: 500,
                color: '#444',
                formatter: function(p) {
                    var n = p.name || '';
                    return n.length > 15 ? n.substring(0, 14) + '…' : n;
                }
            },

            edgeLabel: {
                show: false
            },

            force: {
                repulsion: 300,
                gravity: 0.08,
                edgeLength: [80, 180],
                layoutAnimation: true,
                friction: 0.1
            },

            lineStyle: {
                color: 'source',
                curveness: 0.3,
                width: 1.5,
                opacity: 0.6
            },

            emphasis: {
                focus: 'adjacency',
                lineStyle: {
                    width: 3,
                    opacity: 1
                }
            }
        }]
    };
    interactions.setOption(option);

    // ===== Overlapping Enhancers Network =====
    <?php if ($overlap_count > 0): ?>
    var overlapData = <?php echo $overlap_net_json; ?>;
    var overlapChart = echarts.init(document.getElementById('overlap_network'));

    var oCatColors = {
        "Current Enhancer": { color: "#e74c3c", size: 55, symbol: "diamond" },
        "Overlapping Enhancer": { color: "#2d6b5f", size: 28, symbol: "diamond" },
        "Tissue": { color: "#3498db", size: 18, symbol: "circle" },
        "Cell": { color: "#2ecc71", size: 16, symbol: "roundRect" },
        "Disease": { color: "#f39c12", size: 20, symbol: "triangle" }
    };

    var oCategories = Object.keys(oCatColors).map(function(k) {
        return { name: k, itemStyle: { color: oCatColors[k].color } };
    });

    var oNodes = (overlapData.nodes || []).map(function(n) {
        var cs = oCatColors[n.category] || { size: 20, symbol: "circle", color: "#95a5a6" };
        n.symbolSize = cs.size;
        n.symbol = cs.symbol;
        n.itemStyle = { color: cs.color };
        n.label = { show: true, fontSize: 9, color: '#444' };
        return n;
    });

    var oEdges = (overlapData.links || []).map(function(e) {
        return e;
    });

    var oOption = {
        tooltip: {
            backgroundColor: 'rgba(255,255,255,0.95)',
            borderColor: '#ddd',
            borderWidth: 1,
            padding: [8, 12],
            textStyle: { color: '#333', fontSize: 12 },
            formatter: function(obj) {
                if (obj.dataType == 'node') {
                    return '<div style="font-weight:700;">' + obj.data.category + '</div>' +
                           '<div style="font-size:13px;">' + obj.data.name + '</div>';
                }
                return '';
            }
        },
        legend: [{
            icon: 'circle',
            top: 5,
            left: 'center',
            textStyle: { fontWeight: 600, fontSize: 10, color: '#555' },
            data: oCategories.map(function(a) { return a.name; })
        }],
        animationDuration: 600,
        series: [{
            name: 'Overlapping Enhancers',
            type: 'graph',
            layout: 'force',
            data: oNodes,
            links: oEdges,
            categories: oCategories,
            draggable: true,
            roam: true,
            focusNodeAdjacency: 'allEdges',
            force: {
                repulsion: 250,
                gravity: 0.06,
                edgeLength: [60, 150],
                layoutAnimation: true
            },
            lineStyle: {
                color: 'source',
                curveness: 0.2,
                width: 1.2,
                opacity: 0.5
            },
            emphasis: {
                focus: 'adjacency',
                lineStyle: { width: 2.5, opacity: 1 }
            }
        }]
    };
    overlapChart.setOption(oOption);
    <?php endif; ?>
</script>

<script type="text/javascript">

    // ===== Gene Expression Chart =====
    var Species = "<?php echo $Species; ?>";
    var targetGenes = <?php echo json_encode(array_values($arr_gene)); ?>;

    // Prepare expression data containers
    var expData = {};

    <?php if ($Species == "Homo sapiens"): ?>

    // ---- Fetch: Cell Line ENCODE ----
    var cellLineEncodeLabels = [];
    var cellLineEncodeSeries = {};
    <?php
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM ENdbv2.gene_exp_cell_line_encode WHERE gene_name='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $samples = array_keys($row);
            $vals = array_values($row);
            array_shift($samples); // remove gene_name
            array_shift($vals);
            echo "cellLineEncodeLabels = " . json_encode($samples) . ";\n";
            echo "cellLineEncodeSeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    // ---- Fetch: Primary Cell ENCODE ----
    var primaryCellLabels = [];
    var primaryCellSeries = {};
    <?php
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM ENdbv2.gene_exp_primary_cell_encode WHERE gene_name='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $samples = array_keys($row);
            $vals = array_values($row);
            array_shift($samples);
            array_shift($vals);
            echo "primaryCellLabels = " . json_encode($samples) . ";\n";
            echo "primaryCellSeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    // ---- Fetch: Normal Tissue GTEx ----
    var tissueGTExLabels = [];
    var tissueGTExSeries = {};
    <?php
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM ENdbv2.gene_exp_normal_tissue_gtex WHERE gene_name='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $samples = array_keys($row);
            $vals = array_values($row);
            array_shift($samples);
            array_shift($vals);
            echo "tissueGTExLabels = " . json_encode($samples) . ";\n";
            echo "tissueGTExSeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    // ---- Fetch: Cell Line CCLE ----
    var cellLineCCLELabels = [];
    var cellLineCCLESeries = {};
    <?php
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM ENdbv2.gene_exp_cell_line_ccle WHERE gene_name='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $samples = array_keys($row);
            $vals = array_values($row);
            array_shift($samples);
            array_shift($vals);
            echo "cellLineCCLELabels = " . json_encode($samples) . ";\n";
            echo "cellLineCCLESeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    // ---- Fetch: Cancer TCGA ----
    var cancerTCGALabels = [];
    var cancerTCGASeries = {};
    <?php
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM ENdbv2.gene_exp_tcga WHERE gene_name='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $samples = array_keys($row);
            $vals = array_values($row);
            array_shift($samples);
            array_shift($vals);
            echo "cancerTCGALabels = " . json_encode($samples) . ";\n";
            echo "cancerTCGASeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    expData = {
        'Cell Line (ENCODE)': { labels: cellLineEncodeLabels, series: cellLineEncodeSeries },
        'Primary Cell (ENCODE)': { labels: primaryCellLabels, series: primaryCellSeries },
        'Normal Tissue (GTEx)': { labels: tissueGTExLabels, series: tissueGTExSeries },
        'Cell Line (CCLE)': { labels: cellLineCCLELabels, series: cellLineCCLESeries },
        'Cancer (TCGA)': { labels: cancerTCGALabels, series: cancerTCGASeries }
    };

    <?php elseif ($Species == "Mus musculus"): ?>

    // ---- Fetch: Tissue ENCODE ----
    var encodeMMLabels = [];
    var encodeMMSeries = {};
    <?php
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM ENdbv2.encode_exp_mm WHERE x='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $samples = array_keys($row);
            $vals = array_values($row);
            array_shift($samples);
            array_shift($vals);
            echo "encodeMMLabels = " . json_encode($samples) . ";\n";
            echo "encodeMMSeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    // ---- Fetch: Fantom5 Cell ----
    var fantom5CellLabels = [];
    var fantom5CellSeries = {};
    <?php
    // Fantom5_cell first row has column names as samples
    $sql = "SELECT * FROM ENdbv2.Fantom5_cell LIMIT 1";
    $r = mysqli_query($conn, $sql);
    $firstRow = mysqli_fetch_assoc($r);
    if ($firstRow) {
        echo "fantom5CellLabels = " . json_encode(array_keys($firstRow)) . ";\n";
    }
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM ENdbv2.Fantom5_cell WHERE f1='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $vals = array_values($row);
            echo "fantom5CellSeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    // ---- Fetch: Fantom5 Tissue ----
    var fantom5TissueLabels = [];
    var fantom5TissueSeries = {};
    <?php
    foreach ($arr_gene as $g) {
        $g = trim($g);
        if (empty($g)) continue;
        $sql = "SELECT * FROM tcofbase.Fantom5_tissue WHERE Gene_Name='$g'";
        $r = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($r)) {
            $samples = array_keys($row);
            $vals = array_values($row);
            array_shift($samples);
            array_shift($vals);
            echo "fantom5TissueLabels = " . json_encode($samples) . ";\n";
            echo "fantom5TissueSeries['$g'] = " . json_encode($vals) . ";\n";
        }
    }
    ?>

    expData = {
        'Tissue (ENCODE)': { labels: encodeMMLabels, series: encodeMMSeries },
        'Cell (Fantom5)': { labels: fantom5CellLabels, series: fantom5CellSeries },
        'Tissue (Fantom5)': { labels: fantom5TissueLabels, series: fantom5TissueSeries }
    };

    <?php else: ?>
    expData = {};
    <?php endif; ?>

    // ===== Build UI and Chart =====
    var dataKeys = Object.keys(expData).filter(function(k) {
        return Object.keys(expData[k].series).length > 0;
    });

    if (dataKeys.length > 0) {
        var currentKey = dataKeys.indexOf('Normal Tissue (GTEx)') >= 0 ? 'Normal Tissue (GTEx)' : dataKeys[0];
        var chartColors = ["#418679","#e43c59","#ff7f50","#87cefa","#d48265","#61a0a8","#ca8622","#4BABDE","#FFDE76","#37A2DA"];

        // Build HTML buttons
        var btnHtml = '<div style="text-align:center;margin-bottom:15px;">';
        dataKeys.forEach(function(k, idx) {
            var active = k === currentKey ? 'btn-search' : 'btn-reset';
            btnHtml += '<button class="btn ' + active + ' btn-sm exp-btn" data-key="' + k + '" style="margin:2px 4px;">' + k + '</button>';
        });
        btnHtml += '</div>';
        $('#gene_stat').before(btnHtml);

        function buildOption(key) {
            var data = expData[key];
            if (!data || !data.labels || data.labels.length === 0) return null;
            var series = [];
            var geneIdx = 0;
            Object.keys(data.series).forEach(function(gene) {
                series.push({
                    name: gene,
                    type: 'bar',
                    data: data.series[gene],
                    itemStyle: { color: chartColors[geneIdx % chartColors.length] }
                });
                geneIdx++;
            });
            return {
                color: chartColors,
                tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
                legend: { data: Object.keys(data.series), top: 0 },
                grid: { left: '3%', right: '8%', bottom: '3%', containLabel: true },
                xAxis: { type: 'category', data: data.labels, axisLabel: { rotate: 45, fontSize: 10 } },
                yAxis: { type: 'value', name: 'Gene Expression (TPM/FPKM)' },
                series: series,
                dataZoom: [{ type: 'slider', show: data.labels.length > 15, height: 20, bottom: 0 }]
            };
        }

        var mychart = echarts.init(document.getElementById('gene_stat'));
        mychart.setOption(buildOption(currentKey));

        // Switch on button click
        $(document).on('click', '.exp-btn', function() {
            var key = $(this).data('key');
            $('.exp-btn').removeClass('btn-search').addClass('btn-reset');
            $(this).removeClass('btn-reset').addClass('btn-search');
            mychart.setOption(buildOption(key), true);
        });
    } else {
        $('#gene_stat').html('<div style="text-align:center;padding:80px 20px;color:#8898aa;"><i class="fa fa-info-circle" style="font-size:40px;display:block;margin-bottom:15px;"></i>No gene expression data available for the target genes of this enhancer.</div>');
    }
</script>
</body>
</html>
