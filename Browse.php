<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Browse</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <?php include "public/import.php" ?>
    <style>
        /* ===== Hero Banner ===== */
        .page-hero {
            background: linear-gradient(135deg, #1a3c34 0%, #2d6b5f 40%, #418679 100%);
            padding: 2.2rem 0 1.8rem;
            margin-bottom: 2rem;
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
            font-size: 1.9rem;
            margin-bottom: 0.3rem;
        }
        .page-hero .hero-title .highlight { color: #ffc65e; }
        .page-hero .hero-subtitle {
            color: rgba(255,255,255,0.75);
            font-size: 0.95rem;
        }
        .filter-stats {
            display: flex;
            gap: 1rem;
            margin-top: 0.75rem;
            flex-wrap: wrap;
        }
        .filter-stat-badge {
            background: rgba(255,255,255,0.12);
            color: #fff;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.82rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .filter-stat-badge strong { color: #ffc65e; }

        /* ===== Layout ===== */
        .browse-body { padding-bottom: 2rem; }

        /* ===== Sidebar ===== */
        .side-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 1rem;
            overflow: hidden;
        }
        .side-card-header {
            background: linear-gradient(135deg, #f0f7f5, #e8f2ef);
            padding: 0.8rem 1.2rem;
            font-weight: 700;
            font-size: 0.9rem;
            color: #32325d;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .side-card-header i { color: #418679; }
        .side-card .list-group-item {
            border: none;
            border-bottom: 1px solid #f1f3f5;
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
            color: #525f7f;
            transition: all 0.15s;
            cursor: pointer;
            display: flex;
            align-items: center;
            overflow: hidden;
            min-width: 0;
            gap: 0.6rem;
        }
        .side-card .list-group-item .badge {
            flex-shrink: 0;
            order: 2;
        }
        .side-card .list-group-item .filter-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1 1 0%;
            min-width: 0;
            order: 1;
        }
        .side-card .list-group-item:hover {
            background: #f6fbf9;
            color: #418679;
        }
        .side-card .list-group-item.active {
            background: #e8f4f1;
            color: #2d6b5f;
            font-weight: 600;
            border-left: 3px solid #418679;
        }
        .side-card .badge {
            background: #e9ecef;
            color: #8898aa;
            font-weight: 500;
            font-size: 0.72rem;
            padding: 0.25em 0.6em;
            border-radius: 10px;
        }
        .side-card .list-group-item.active .badge {
            background: #418679;
            color: #fff;
        }

        /* ===== Old table/fenye styles preserved ===== */
        *[class*="list-group"] {
            width: 100px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        a { cursor: pointer; }
        .list-group-item:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .list-group-item:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        table { width: 100%; }
        .list-group-item { width: 100%; }
        td a { white-space: nowrap; }
        ul.pagination li a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0 1px;
            width: 31px;
            height: 31px;
            font-size: 0.875rem;
            background-color: #fff;
            border: 0.0625rem solid #dee2e6;
            border-radius: 6px;
        }
        ul.pagination li a:hover {
            z-index: 2;
            color: #418679;
            text-decoration: none;
            background-color: #e8f4f1;
            border-color: #418679;
        }
        ul.pagination li.active a {
            color: #fff;
            background-color: #418679;
            border-color: #418679;
        }
        ul.pagination li.active a:hover { color: white; }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .1em;
        }
        .label-primary { background-color: #418679; }
        .label {
            cursor: pointer;
            padding: 0 5px 0 0;
            line-height: 18px;
            height: 20px;
            display: inline-block;
        }
        .label > div {
            background: #fff;
            display: inline-block;
            height: 100%;
            border: 1px solid #418679;
            color: #999;
            cursor: pointer;
            line-height: 18px;
            width: 20px;
            left: 0;
            position: relative;
        }
        .label:hover div { color: black; }
        .user_select {
            display: inline-block;
            margin: 0 2px 0 0;
            border: 1px solid #f0f0f0;
            padding: 0 5px;
            background: #418679;
            color: white;
            position: relative;
            top: 2px;
            font-weight: bold;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        .badge { text-transform: uppercase; width: 54px; }
        #table_all tr > td:first-child { text-transform: capitalize; }

        /* ===== Main Table Area ===== */
        .table-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 1.5rem;
        }
        #example {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
        }
        #example thead th {
            background: linear-gradient(180deg, #f0f7f5, #e8f2ef);
            color: #32325d;
            font-weight: 700;
            font-size: 0.82rem;
            border-bottom: 2px solid #418679;
            padding: 0.7rem 0.6rem;
            white-space: nowrap;
        }
        #example tbody td {
            padding: 0.6rem;
            font-size: 0.85rem;
            color: #525f7f;
            border-bottom: 1px solid #f1f3f5;
        }
        #example tbody tr:hover { background: #f6fbf9; }
        #example tbody a {
            color: #418679;
            font-weight: 600;
        }
        #example tbody a:hover {
            color: #1a3c34;
            text-decoration: underline;
        }
        .dataTables_wrapper .btn-default {
            background: #418679;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.4rem 0.9rem;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        .dataTables_wrapper .btn-default:hover {
            background: #2d6b5f;
        }

        /* Fenye tables in sidebar */
        .fenye {
            margin-bottom: 0.5rem;
            width: 100%;
            table-layout: fixed;
        }
        .fenye th {
            padding: 0;
        }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .page-hero { padding: 1.5rem 0 1.2rem; }
            .page-hero .hero-title { font-size: 1.4rem; }
            .side-card { margin-bottom: 0.75rem; }
            .filter-stat-badge { font-size: 0.72rem; padding: 0.25rem 0.6rem; }
        }
    </style>
</head>

<body>
<?php include "public/header.php" ?>

<!-- ===== Hero Banner ===== -->
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <a href="Search.php">Search</a> &nbsp;/&nbsp; <span>Browse</span>
        </div>
        <h1 class="hero-title"><span class="highlight">Browse</span> Enhancers</h1>
        <p class="hero-subtitle">Filter by species, tissue, cell type, disease, or experiment to explore our curated enhancer collection</p>
        <div class="filter-stats">
            <span class="filter-stat-badge"><i class="fa fa-filter"></i> Species</span>
            <span class="filter-stat-badge"><i class="fa fa-flask"></i> Tissue</span>
            <span class="filter-stat-badge"><i class="fa fa-eyedropper"></i> Cell Type</span>
            <span class="filter-stat-badge"><i class="fa fa-medkit"></i> Disease</span>
            <span class="filter-stat-badge"><i class="fa fa-cogs"></i> Experiment</span>
        </div>
    </div>
</div>

<!-- ===== Main Content ===== -->
<div class="container browse-body">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 col-md-3 col-xs-12">
            <?php
            include 'public/conn.php';
            $select = isset($_GET['select']) ? "where {$_GET['select']}" : "";
            $select_FIND_IN_SET = isset($_GET['select_FIND_IN_SET']) ? "where {$_GET['select_FIND_IN_SET']}" : "";
            if ($select != "") {
                $select = str_replace(":", "=", $select);
                $select = str_replace("|", " and ", $select);
            }
            if ($select_FIND_IN_SET != "") {
                $select_FIND_IN_SET = str_replace("Tissue_name", "Tissue", $select_FIND_IN_SET);
                $select_FIND_IN_SET = str_replace("Cell_name", "Cell_Source", $select_FIND_IN_SET);
                $select_FIND_IN_SET = str_replace("Disease", "Disease_Name", $select_FIND_IN_SET);
                $select_FIND_IN_SET = str_replace("Enhancer_experiment", "Experiment_Type", $select_FIND_IN_SET);
                $select_FIND_IN_SET = str_replace("|", " and ", $select_FIND_IN_SET);
                // Experiment_Type values may contain commas (e.g. "Enhancer capture Hi-C, in vivo functional validation")
                // FIND_IN_SET uses comma as delimiter, so it cannot match such values.
                // Replace with LIKE-based matching: unify all delimiters (', ', ' | ', ';') to '|', then match exactly.
                $select_FIND_IN_SET = preg_replace(
                    "/FIND_IN_SET\('([^']+)',\s*Experiment_Type\)/",
                    "CONCAT('|',REPLACE(REPLACE(REPLACE(Experiment_Type,', ','|'),' | ','|'),';','|'),'|') LIKE CONCAT('%|',REPLACE('$1',', ','|'),'|%')",
                    $select_FIND_IN_SET
                );
            }
            $sample_sql = "SELECT Species, Tissue as Tissue_name, Cell_Source as Cell_name, Disease_Name as Disease, Experiment_Type from enhancer_main $select_FIND_IN_SET";
            $sample_result = mysqli_query($conn, $sample_sql);
            $i = 0;
            $have_value = [];
            $keys = [];
            $data = [];
            $keysRepeat = [];
            while ($rows = mysqli_fetch_assoc($sample_result)) {
                foreach ($rows as $key => $values) {
                    // Experiment_Type uses ';' as delimiter (e.g. "ChIP-seq;Hi-C;CRISPR")
                    $delim = ($key === 'Experiment_Type') ? ';' : ',';
                    $values = preg_split('/\s*[,;]\s*/', $values, -1, PREG_SPLIT_NO_EMPTY);
                    foreach ($values as $value) {
                        if ($value == NULL || $value === '--' || $value === 'NA') continue;
                        $have_value[$value] = 1;
                        $keys[$key][$i] = $value;
                        $i++;
                    }
                    $i++;
                }
            }
            foreach ($keys as $key => $value) {
                $keysRepeat[$key] = array_count_values($value);
            }
            $j = 0;
            foreach ($keysRepeat as $type => $values) {
                $i = 0;
                if ($type == "Disease") krsort($values); else arsort($values);
                foreach ($values as $name => $val) {
                    if ($name == "--" || $name == "NA") continue;
                    $name_id = preg_replace('/[\s,\/()+.]/', "_", $name);
                    $data_select[$type][$i]["id"] = $i;
                    $data_select[$type][$i]["name"] = "<a onclick='select_data(this)' class='$name_id' data-name='$name' data-type='$type'>$name</a>";
                    $data[$type][][0] = "<a class='list-group-item' id='$name_id' data-name='$name' data-type='$type'><span class='badge'>$val</span><span class='filter-text'>$name</span></a>";
                    $i++;
                }
                $j++;
            }
            ?>

            <!-- Filter Categories -->
            <?php
            $filterIcons = [
                'Species' => 'fa-paw',
                'Tissue_name' => 'fa-flask',
                'Cell_name' => 'fa-eyedropper',
                'Disease' => 'fa-medkit',
                'Experiment_Type' => 'fa-cogs'
            ];

?>
<script>
    function table(id, data, pageRow) {
        var tbody = document.getElementById(id).children[1];
        var ul = document.getElementById(id + "_ul");
        var data = data;
        var dataLength = data.length;
        var curPage = 1;
        var pageRow = pageRow;
        var pageAll = parseInt(dataLength / pageRow) < dataLength / pageRow ? parseInt(dataLength / pageRow + 1) : parseInt(dataLength / pageRow);

        function pageFresh() {
            tbody.innerHTML = "";
            ul.innerHTML = "";
            curPage = parseInt(curPage);
            var start = (curPage - 1) * pageRow;
            var end = dataLength > curPage * pageRow ? curPage * pageRow : dataLength;
            for (let i = start; i < end; i++) {
                var row = data[i];
                var tr = document.createElement("tr");
                Object.keys(row).forEach(function (key) {
                    var td = document.createElement("td");
                    td.innerHTML = row[key];
                    tr.appendChild(td);
                });
                tbody.appendChild(tr);
            }
            var url_param = "", params = [], arr_params = [];
            arr_FIND_IN_SET_params = [];
            var url = decodeURIComponent(window.location.href);
            var url_param = url.split("?")[1];
            if (url_param) {
                var params = url_param.split("=")[1];
                var params = params.split("|");
                var arr_FIND_IN_SET_params = new Array;
                for (let param in params) {
                    $("#" + params[param].split("FIND_IN_SET('")[1].split("',")[0].replace(/[\s,\/()+.]/g, "_")).attr("class", "list-group-item active");
                    $("." + params[param].split("('")[1].split("',")[0].replace(/[\s,\/()+.]/g, "_")).parent("div").parents("li").attr("class", "sm_selected");
                    arr_FIND_IN_SET_params[params[param]] = params[param];
                }
            }
            $("a").click(function (doc) {
                var $target = $(doc.target).closest('a.list-group-item');
                if ($target.length === 0) return;
                var type = $target.data('type');
                var name = $target.data('name');
                    var sub_params = type + ":'" + name + "'";
                    if (arr_params[sub_params] != sub_params) {
                        arr_params[sub_params] = sub_params;
                    } else {
                        arr_params[sub_params] = "";
                    }
                    var FIND_IN_SET_params = " FIND_IN_SET('" + name + "'," + type + ")";
                    if (arr_FIND_IN_SET_params[FIND_IN_SET_params] != FIND_IN_SET_params) {
                        arr_FIND_IN_SET_params[FIND_IN_SET_params] = FIND_IN_SET_params;
                    } else {
                        arr_FIND_IN_SET_params[FIND_IN_SET_params] = "";
                    }
                    var select_FIND_IN_SET = "select_FIND_IN_SET=";
                    var select_is = 0;
                    for (i in arr_FIND_IN_SET_params) {
                        if (arr_FIND_IN_SET_params[i] == "") continue;
                        select_is = 1;
                        select_FIND_IN_SET += (arr_FIND_IN_SET_params[i] + "|");
                    }
                    if (select_is == 1) {
                        select_FIND_IN_SET = select_FIND_IN_SET.slice(0, -1);
                    } else {
                        select_FIND_IN_SET = "";
                    }
                    window.location.href = "Browse.php?" + select_FIND_IN_SET.replace(/\+/g, "%2B");
            });
            if (dataLength > 5) {
                if (pageAll <= 5) {
                    for (let i = 1; i <= pageAll; i++) {
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = i.toString();
                        a.id = id + i.toString();
                        li.appendChild(a);
                        ul.appendChild(li);
                    }
                } else {
                    if (curPage <= 3) {
                        for (let i = 1; i <= 4; i++) {
                            var li = document.createElement("li");
                            var a = document.createElement("a");
                            a.innerHTML = i.toString();
                            a.id = id + i.toString();
                            li.appendChild(a);
                            ul.appendChild(li);
                        }
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = "...";
                        li.appendChild(a);
                        ul.appendChild(li);
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = pageAll;
                        a.id = id + pageAll.toString();
                        li.appendChild(a);
                        ul.appendChild(li);
                    } else if (curPage >= pageAll - 2) {
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = 1;
                        a.id = id + "1";
                        li.appendChild(a);
                        ul.appendChild(li);
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = "...";
                        li.appendChild(a);
                        ul.appendChild(li);
                        for (let i = pageAll - 3; i <= pageAll; i++) {
                            var li = document.createElement("li");
                            var a = document.createElement("a");
                            a.innerHTML = i;
                            a.id = id + i.toString();
                            li.appendChild(a);
                            ul.appendChild(li);
                        }
                    } else {
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = 1;
                        a.id = id + "1";
                        li.appendChild(a);
                        ul.appendChild(li);
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = "...";
                        li.appendChild(a);
                        ul.appendChild(li);
                        for (let i = curPage - 1; i <= curPage + 1; i++) {
                            var li = document.createElement("li");
                            var a = document.createElement("a");
                            a.innerHTML = i;
                            a.id = id + i.toString();
                            li.appendChild(a);
                            ul.appendChild(li);
                        }
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = "...";
                        li.appendChild(a);
                        ul.appendChild(li);
                        var li = document.createElement("li");
                        var a = document.createElement("a");
                        a.innerHTML = pageAll;
                        a.id = id + pageAll.toString();
                        li.appendChild(a);
                        ul.appendChild(li);
                    }
                }
                document.getElementById(id + curPage.toString()).parentElement.className = "active";
                ul.onclick = function (e) {
                    if (e.target.nodeName == "A" && e.target.innerHTML != "...") {
                        switch (e.target.innerHTML) {
                            case 'Previous': curPage = curPage > 1 ? curPage - 1 : 1; break;
                            case 'Next': curPage = curPage == pageAll ? curPage : curPage + 1; break;
                            default: curPage = e.target.innerHTML; break;
                        }
                        pageFresh();
                    }
                };
            }
        }
        pageFresh();
    }
</script>
<?php
            foreach ($data as $key => $value) {
                $type = $key;
                $safeKey = preg_replace('/[\s,\/]/', "_", $key) . "_";
                $icon = isset($filterIcons[$type]) ? $filterIcons[$type] : 'fa-tag';
                $displayName = str_replace('_', ' ', $key);
                echo "<div class='side-card'>";
                echo "<div class='side-card-header'><i class='fa $icon'></i>$displayName</div>";
                echo "<table class='fenye' id=\"$safeKey\"><thead><tr><th></th></tr></thead><tbody></tbody></table>";
                echo "<ul class='pagination pagination-sm px-3 pb-2 pt-1' id=\"" . $safeKey . "_ul\"></ul>";
                echo "</div>";
                echo "<script type='text/javascript'>";
                echo "var data_$safeKey = " . json_encode($value) . ";";
                echo "var $safeKey = new table('$safeKey',data_$safeKey,5);";
                echo $safeKey . ";";
                echo "</script>";
            }
            ?>
        </div>

        <!-- Main Table -->
        <div class="col-lg-9 col-md-9 col-xs-12">
            <div class="table-card">
                <h5 style="font-weight:700;color:#32325d;margin-bottom:1rem;">
                    <i class="fa fa-table mr-2" style="color:#418679;"></i>Enhancer Records
                </h5>
                <table class="table table-striped table-hover" cellspacing="0" id="example">
                    <thead>
                    <tr>
                        <th>Enhancer ID</th>
                        <th>Genome Location</th>
                        <th>Tissue</th>
                        <th>Cell Source</th>
                        <th>Disease</th>
                        <th>Experiment Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sample_table_sql = "SELECT * from enhancer_main $select_FIND_IN_SET";
                    $sample_table_result = mysqli_query($conn, $sample_table_sql);
                    while ($rows = mysqli_fetch_assoc($sample_table_result)) {
                        echo "<tr>";
                        echo "<td><a href='search/Detail.php?Species={$rows["Species"]}&Enhancer_id={$rows["Enhancer_id"]}' target='_blank'>{$rows["Enhancer_id"]}</a></td>";
                        echo "<td>{$rows["Chromosome"]}:{$rows["Start_position"]}~{$rows["End_position"]}</td>";
                        echo "<td>{$rows["Tissue"]}</td>";
                        echo "<td>{$rows["Cell_Source"]}</td>";
                        echo "<td>{$rows["Disease_Name"]}</td>";
                        $exp_raw = $rows["Experiment_Type"];
                        echo "<td>" . (!empty($exp_raw) && $exp_raw !== '--' && $exp_raw !== 'NA' ? $exp_raw : '--') . "</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "public/footer.php" ?>
<script>
    function select_data(doc) {
        var url_param = "", params = [], arr_params = [];
        arr_FIND_IN_SET_params = [];
        var url = decodeURIComponent(window.location.href);
        var url_param = url.split("?")[1];
        if (url_param) {
            var params = url_param.split("=")[1];
            var params = params.split("|");
            var arr_FIND_IN_SET_params = new Array;
            for (let param in params) {
                $("#" + params[param].split("FIND_IN_SET('")[1].split("',")[0].replace(/[\s,\/()+.]/g, "_")).attr("class", "list-group-item active");
                $("." + params[param].split("('")[1].split("',")[0].replace(/[\s,\/()+.]/g, "_")).parent("div").parents("li").attr("class", "sm_selected");
                arr_FIND_IN_SET_params[params[param]] = params[param];
            }
        }
        var type = doc.dataset.type;
        var name = doc.dataset.name;
        var sub_params = type + ":'" + name + "'";
        if (arr_params[sub_params] != sub_params) {
            arr_params[sub_params] = sub_params;
        } else {
            arr_params[sub_params] = "";
        }
        var FIND_IN_SET_params = " FIND_IN_SET('" + name + "'," + type + ")";
        if (arr_FIND_IN_SET_params[FIND_IN_SET_params] != FIND_IN_SET_params) {
            arr_FIND_IN_SET_params[FIND_IN_SET_params] = FIND_IN_SET_params;
        } else {
            arr_FIND_IN_SET_params[FIND_IN_SET_params] = "";
        }
        var select_FIND_IN_SET = "select_FIND_IN_SET=";
        var select_is = 0;
        for (i in arr_FIND_IN_SET_params) {
            if (arr_FIND_IN_SET_params[i] == "") continue;
            select_is = 1;
            select_FIND_IN_SET += (arr_FIND_IN_SET_params[i] + "|");
        }
        if (select_is == 1) {
            select_FIND_IN_SET = select_FIND_IN_SET.slice(0, -1);
        } else {
            select_FIND_IN_SET = "";
        }
        window.location.href = "Browse.php?" + select_FIND_IN_SET.replace(/\+/g, "%2B");
    }

    $(document).ready(function () {
        $('#example').dataTable({
            dom: '<"row"<"col-lg-12 d-flex justify-content-between align-items-baseline"<iB>f><"col-lg-12 mb-2"rt><"col-lg-12 d-flex justify-content-between align-items-end"lp>>',
            buttons: [{
                extend: 'csvHtml5',
                text: '<i class="fa fa-download mr-1"></i> Export CSV'
            }],
            "autoWidth": false,
            "scrollX": true,
            "language": {
                "paginate": { "first": "<<", "previous": "<", "next": ">", "last": ">>" }
            }
        });
    });
</script>

</body>
