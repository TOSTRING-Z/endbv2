<?php include "../public/public.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENdb</title>
    <?php include "../public/import.php" ?>
    <style>
        img {
            width: 20px;
            resize: ;
            position: relative;
            top: -1px;
        }
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
        .analysis-card {
            background: #fff; border-radius: 12px; box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            margin-bottom: 25px; border: 1px solid #e8f0eb; overflow: hidden;
        }
        .analysis-card .card-header-custom {
            background: linear-gradient(135deg, #f0f7f2, #e8f5e9);
            padding: 18px 24px; border-bottom: 1px solid #d4e8d8;
            font-size: 20px; font-weight: 700; color: #1a5c2a;
        }
        .analysis-card .card-body-custom { padding: 24px; }
        .info-table-custom td { padding: 10px 15px; border-bottom: 1px solid #eef5f0; }
        .info-table-custom td:first-child { background: #f8fdf9; font-weight: 600; color: #1a5c2a; width: 160px; }
        .btn-export {
            background: linear-gradient(135deg, #418679, #2d6b5f); color: #fff; border: none;
            padding: 8px 18px; font-size: 14px; font-weight: 600; border-radius: 6px;
            cursor: pointer; transition: all 0.3s;
        }
        .btn-export:hover {
            background: linear-gradient(135deg, #2d6b5f, #1a3c34);
            transform: translateY(-1px); box-shadow: 0 4px 12px rgba(65,134,121,0.3); color: #fff;
        }
    </style>
</head>
<body>
<?php include "../public/header.php" ?>
<?php
include '../public/conn.php';
$enhancer_id = trim($_REQUEST["enhancer_id"]);
$sql = "select * from enhancer_main where Enhancer_id='$enhancer_id'";
$results = mysqli_query($conn, $sql);
if (!$results) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while ($rows = mysqli_fetch_assoc($results)) {
    $TFs[] = $rows['TF'];
}
$tf_name = join(",", $TFs);
$TFs = preg_split("/,+/i", $tf_name);
$TFs = array_diff($TFs, [""]);
$tf_name = join("','", array_unique($TFs));
$tfs = join(",", array_unique($TFs));

$species_table_map = [
    'Homo sapiens' => 'human',
    'Mus musculus' => 'mouse',
];
$species_table = $species_table_map[$_POST["species"]] ?? 'human';
$sql = "SELECT *
        from `{$species_table}_tf_target`
        where TF in ('$tf_name')";

$results = mysqli_query($conn, $sql);
$gene_list_start = [];
while ($rows = mysqli_fetch_assoc($results)) {
    $genes = preg_split("/;/", $rows['Targets']);
    $gene_list_start = $gene_list_start + $genes;
}
$targets = join(", ", array_unique($gene_list_start));
$min = $_REQUEST["min"];
$max = $_REQUEST["max"];
$Threshold = $_REQUEST["Threshold"];
$databases = join(';', $_REQUEST['databases']);

$alert = "";
if (preg_split("/;/", $databases) < 10) {
    $alert .= "1. There are no enriched pathways from the pathway database(s) user selected. Please choose other ones.";
}
$adjust = $_REQUEST["adjust"] == 'on' ? 1 : 0;
$uniq = [];
?>
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/"><i class="ri-home-4-line"></i> Home</a> &nbsp;/&nbsp;
            <a href="/ENdb/Analysis/">Analysis</a> &nbsp;/&nbsp;
            <span>Pathway Enrichment Result</span>
        </div>
        <h1 class="hero-title"><i class="ri-pie-chart-2-line"></i> Pathway Enrichment Result</h1>
        <p class="hero-subtitle">Pathway enrichment analysis of enhancer-TF targets</p>
    </div>
</div>
<div class="container" style="margin-top:-20px; position:relative; z-index:10;">
    <div class="analysis-card">
        <div class="card-header-custom">
            <i class="ri-folder-info-line"></i> Information
        </div>
        <div class="card-body-custom">
            <table class="table info-table-custom" style="margin-bottom:0;">
                        <tr>
                            <td><strong>Enhancer id:</strong></td>
                            <td><?php echo $enhancer_id; ?></td>
                        </tr>
                        <tr style="color: red;font-weight:bold;">
                            <td><strong>TFs:</strong></td>
                            <td><?php echo $tfs; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Target genes:</strong></td>
                            <td><?php echo $targets; ?></td>
                        </tr>
            </table>
        </div>
    </div>
    <div class="analysis-card">
        <div class="card-header-custom">
            <i class="ri-folders-line"></i> Pathway enrichment analysis of enhancer-TF targets
        </div>
        <div class="card-body-custom" style="padding:16px 24px;">
            <table style="width:100%;" id="example"
                   class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th>Pathway ID <span class="glyphicon glyphicon-question-sign"
                                         title="Click to view Pathway network on ComPAT web server"></span></th>
                    <th>Pathway name</th>
                    <th>Pathway source</th>
                    <th>Annotated gene</th>
                    <th>Annotated gene number</th>
                    <th>Total gene number</th>
                    <th>TF <span class="glyphicon glyphicon-question-sign"
                                 title="Based on motif change and ChIP-seq data, the TFs from these pathways are variation-associated."></span>
                    </th>
                    <th>TF number</th>
                    <th>P value</th>
                    <th>FDR <span class="glyphicon glyphicon-question-sign"
                                  title="False discovery rate (FDR) : the corrected p-value."></span></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="analysis-card" id="convert">
        <div class="card-header-custom">
            <i class="ri-folder-info-line"></i> ID Convert Table
        </div>
        <div class="card-body-custom">
            <p style="font-size:15px;color:#555;margin-bottom:15px;"><i class="ri-attachment-line" style="font-size: 20px;vertical-align:middle;"></i> <b>Users may not input gene symbol. The ENdb can convert alias; Ensembl ID; NCBI Refseq ID of genes into gene symbol.</b></p>
            <div id="symbol"></div>
        </div>
    </div>
</div>
<?php include "../public/footer.php"; ?>
<?php
$gene_list_end = [];
$rs = mysqli_query($conn, "select distinct symbol FROM cjx.idConvert where symbol in  ('" . join("','", $gene_list_start) . "')");
while ($row = mysqli_fetch_assoc($rs)) {
    array_push($gene_list_end, $row["symbol"]);
}
$gene_list_diff = array_diff($gene_list_start, $gene_list_end);
$gene_list = json_encode(trim(join("\t", $gene_list_diff)));
?>
<script>
    window.table = null;
    var value = <?php echo $gene_list ?>;
    var diff = <?php echo json_encode(join("\n", $gene_list_diff)) ?>;
    console.log(value);

    function getTableContent(n) {
        var rs = [];
        var nTrs = window.table.fnGetNodes();
        for (var i = 0; i < nTrs.length; i++) {
            var t = window.table.fnGetData(nTrs[i]);
            rs.push(t[n]);
        }
        return rs
    }

    if (value) {
        alert("The following ID or alias will be converted to gene symbol:\n" + diff);

        window.table = null;
        $('#symbol').html("<table id=\"symbol_table\" style=\"width: 100%\" class=\"table table-striped table-bordered table-hover table-condensed\">\n" +
            "                <thead>\n" +
            "                <tr>\n" +
            "                    <th>Gene Symbol</th>\n" +
            "                    <th>Entrez Gene ID</th>\n" +
            "                    <th>Also known as</th>\n" +
            "                    <th>Ensembl ID</th>\n" +
            "                    <th>NCBI Refseq ID</th>\n" +
            "                </tr>\n" +
            "                </thead>\n" +
            "            </table>");
        window.table = $('#symbol_table').dataTable({
            dom: '<"row"<"col-lg-12 d-flex justify-content-between align-items-baseline"<iB>f><"col-lg-12 mb-2"rt><"col-lg-12 d-flex justify-content-between align-items-end"lp>>',
            buttons: [{
                extend: 'csvHtml5',
                text: '<i class="fa fa-floppy-o btn btn-default position-relative"></i>'
            }],
            scrollX: true,
            "autoWidth": false,
            "language": {
                "paginate": {
                    "first": "<<",
                    "previous": "<",
                    "next": ">",
                    "last": ">>"
                }
            },
            ajax: {
                async: false,
                type: "POST",
                url: "id_convert_server.php",
                data: {
                    "params": value,
                    "type": "other2symbol"
                }
            }
        });
        value = getTableContent(0).concat(<?php echo json_encode($gene_list_end) ?>);
    } else {
        $("#convert").hide();
        value = <?php echo json_encode($gene_list_end) ?>;
    }


</script>

<script type="text/javascript">
    var threshold = <?php echo !empty($Threshold) ? $Threshold : 0.05 ?>;
    var database = "<?php echo $databases ?>";
    var adjust = <?php echo !empty($adjust) ? $adjust : 0 ?>;
    var min = <?php echo !empty($min) ? $min : 10 ?>;
    var max = <?php echo !empty($max) ? $max : 500 ?>;

    window.aTable = $("#example").dataTable({
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
        },
        order: [[6, "desc"]], //默认排序
        ajax: {
            url: 'http://www.licpathway.net/BiocApi/kegg',
            async: false,
            type: 'POST',
            data: {
                genes: JSON.stringify(value),
                min: min,
                max: max,
                adjust: adjust,
                Threshold: threshold,
                database: database
            }
        },
        columns: [
            {"data": "pathwayID"},
            {"data": "pathwayName"},
            {"data": "Source"},
            {"data": "AnnGene"},
            {"data": null},
            {"data": "GeneNumber"},
            {"data": "Terminal_TF"},
            {"data": "Total_gene_number"},
            {"data": "PValue"},
            {"data": "FDR"}
        ],
        columnDefs: [{
            "targets": 0,
            "data": null,
            "render": function (data, type, row) {
                var html = '<a href="http://licpathway.net/msg/ComPAT/node2ptsg.do?id=' + row.pathwayID + '&name=' + row.pathwayName + '&&source=' + row.Source + '&&species=' + row.Species + '&annGene=' + row.AnnGene + '&geneNumber=' + row.GeneNumber + '&pValue=' + row.PValue + '&fDR=' + row.FDR + '&tf=' + row.Terminal_TF + '">' + row.pathwayID + '</a>';
                return html;
            }
        }, {
            "targets": 4,
            "data": null,
            "render": function (data, type, row) {
                return row.AnnGene.split(';').length;
            }
        }],
        createdRow: function (row, data, dataIndex) {
            //console.log(data);
            $(row).children('td').eq(4).attr('id', data.pathwayID);
            if (data.pathwayName.length > 10) {//只有超长，才有td点击事件
                $(row).children('td').eq(1).attr('title', data.pathwayName);
                $(row).children('td').eq(1).css("color", "red");
            }
            if (data.AnnGene)
                if (data.AnnGene.length >= 2) {//只有超长，才有td点击事件
                    $(row).children('td').eq(3).attr('title', data.AnnGene);
                    $(row).children('td').eq(3).css("color", "red");
                }
            if (data.Terminal_TF)
                if (data.Terminal_TF.length > 3) {//只有超长，才有td点击事件
                    $(row).children('td').eq(6).attr('title', data.Terminal_TF);
                    $(row).children('td').eq(6).css("color", "red");
                }
            $(row).children('td').each((i, e) => {
                if (e.innerHTML == '') {
                    $(e).html('\\')
                }
            })
        },
    });
</script>

<script>
    var rs = [];
    var nTrs = window.aTable.fnGetNodes();
    for (var i = 0; i < nTrs.length; i++) {
        var t = window.aTable.fnGetData(nTrs[i]);
        rs.push(t[i]);
    }
    if (rs.length == 0) {
        $.ajax({
            url: 'http://www.licpathway.net/BiocApi/kegg',
            async: false,
            type: 'POST',
            data: {
                genes: JSON.stringify(value),
                min: min,
                max: max,
                adjust: 0,
                Threshold: 0.05,
                database: "KEGG;NetPath;Reactome;WikiPathways;PANTHER;PID;HumanCyc;CTD;SMPDB;INOH"
            },
            success: function (d) {
                if (d.recordsTotal != 0) {
                    isreturn = 0;
                    if (database.split(";").length < 20) {
                        $.ajax({
                            url: 'http://www.licpathway.net/BiocApi/kegg',
                            async: false,
                            type: 'POST',
                            data: {
                                genes: JSON.stringify(value),
                                min: min,
                                max: max,
                                adjust: adjust,
                                Threshold: threshold,
                                database: "KEGG;NetPath;Reactome;WikiPathways;PANTHER;PID;HumanCyc;CTD;SMPDB;INOH"
                            },
                            success: function (data) {
                                if (data.recordsTotal != 0) {
                                    alert("There are no enriched pathways from the pathway database(s) user selected. Please choose other ones.\n");
                                    isreturn = 1
                                }
                            }
                        });
                    }
                    if (isreturn) return;
                    if (threshold < 0.05) {
                        $.ajax({
                            url: 'http://www.licpathway.net/BiocApi/kegg',
                            async: false,
                            type: 'POST',
                            data: {
                                genes: JSON.stringify(value),
                                min: min,
                                max: max,
                                adjust: adjust,
                                Threshold: 0.05,
                                database: database
                            },
                            success: function (data) {
                                if (data.recordsTotal != 0) {
                                    alert("The threshold (P value) is strict. Please set a new threshold with relaxation.\n");
                                    isreturn = 1
                                }
                            }
                        });
                    }
                    if (isreturn) return;
                    if (adjust != 0) {
                        $.ajax({
                            url: 'http://www.licpathway.net/BiocApi/kegg',
                            async: false,
                            type: 'POST',
                            data: {
                                genes: JSON.stringify(value),
                                min: min,
                                max: max,
                                adjust: 0,
                                Threshold: threshold,
                                database: database
                            },
                            success: function (data) {
                                if (data.recordsTotal != 0) {
                                    alert("The threshold (FDR) is strict. Please set a new threshold with relaxation.\n");
                                    isreturn = 1
                                }
                            }
                        });
                    }
                    if (isreturn) return;
                    if (database.split(";").length < 20 && threshold < 0.05) {
                        $.ajax({
                            url: 'http://www.licpathway.net/BiocApi/kegg',
                            async: false,
                            type: 'POST',
                            data: {
                                genes: JSON.stringify(value),
                                min: min,
                                max: max,
                                adjust: adjust,
                                Threshold: 0.05,
                                database: "KEGG;NetPath;Reactome;WikiPathways;PANTHER;PID;HumanCyc;CTD;SMPDB;INOH"
                            },
                            success: function (data) {
                                if (data.recordsTotal != 0) {
                                    alert("1. There are no enriched pathways from the pathway database(s) user selected. Please choose other ones.\n2. The threshold (P value) is strict. Please set a new threshold with relaxation.");
                                    isreturn = 1
                                }
                            }
                        });
                    }
                    if (isreturn) return;
                    if (database.split(";").length < 20 && adjust != 0) {
                        $.ajax({
                            url: 'http://www.licpathway.net/BiocApi/kegg',
                            async: false,
                            type: 'POST',
                            data: {
                                genes: JSON.stringify(value),
                                min: min,
                                max: max,
                                adjust: 0,
                                Threshold: threshold,
                                database: "KEGG;NetPath;Reactome;WikiPathways;PANTHER;PID;HumanCyc;CTD;SMPDB;INOH"
                            },
                            success: function (data) {
                                if (data.recordsTotal != 0) {
                                    alert("1. There are no enriched pathways from the pathway database(s) user selected. Please choose other ones.\n2. The threshold (FDR) is strict. Please set a new threshold with relaxation.\n");
                                    isreturn = 1
                                }
                            }
                        });
                    }
                    if (isreturn) return;
                    if (adjust != 0 && threshold < 0.05) {
                        $.ajax({
                            url: 'http://www.licpathway.net/BiocApi/kegg',
                            async: false,
                            type: 'POST',
                            data: {
                                genes: JSON.stringify(value),
                                min: min,
                                max: max,
                                adjust: 0,
                                Threshold: 0.05,
                                database: database
                            },
                            success: function (data) {
                                if (data.recordsTotal != 0) {
                                    alert("1. The threshold (P value) is strict. Please set a new threshold with relaxation.\n2. The threshold (FDR) is strict. Please set a new threshold with relaxation.\n");
                                    isreturn = 1
                                }
                            }
                        });
                    }
                    if (isreturn) return;
                    alert("1. There are no enriched pathways from the pathway database(s) user selected. Please choose other ones.\n2. The threshold (P value) is strict. Please set a new threshold with relaxation.\n3. The threshold (FDR) is strict. Please set a new threshold with relaxation.\n");
                } else {
                    alert("Please input a set of more genes.");
                }
            }
        });
    }
</script>
</body>
<script>
    $('#tf_target_genes').DataTable({
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
        },
        createdRow: function (row, data, dataIndex) {
            $(row).children('td').each((i, e) => {
                switch (i) {
                    case 3:
                        return
                    default:
                        break
                }
                if (e.innerText === '')
                    $(e).html('\\');
                $(e).attr('title', e.innerText);
            });
        }
    });
</script>
</html>
