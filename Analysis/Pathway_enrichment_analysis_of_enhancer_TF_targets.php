<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <?php include "../public/import.php" ?>
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

        .analysis-card {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            overflow: hidden;
        }
        .analysis-card .card-header-custom {
            background: linear-gradient(135deg, #f0f7f5, #e8f2ef);
            padding: 18px 24px;
            font-weight: 700;
            font-size: 1.05rem;
            color: #32325d;
            border-bottom: 1px solid #dde8e4;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .analysis-card .card-body-custom { padding: 24px; }
        .form-label-custom {
            font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 15px;
        }
        .btn-submit-custom {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            color: #fff; border: none; padding: 12px 30px; font-size: 16px;
            font-weight: 600; border-radius: 8px; cursor: pointer; transition: all 0.3s;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .btn-submit-custom:hover {
            background: linear-gradient(135deg, #2d6b5f, #1a3c34);
            transform: translateY(-1px); box-shadow: 0 4px 12px rgba(65,134,121,0.3); color: #fff;
        }
        .btn-reset-custom { background: #6c757d; color: #fff; border: none; padding: 12px 24px; font-size: 15px; font-weight: 500; border-radius: 8px; cursor: pointer; transition: all 0.3s; }
        .btn-reset-custom:hover { background: #5a6268; color: #fff; }
        .btn-example-custom { background: #17a2b8; color: #fff; border: none; padding: 12px 24px; font-size: 15px; font-weight: 500; border-radius: 8px; cursor: pointer; transition: all 0.3s; }
        .btn-example-custom:hover { background: #138496; color: #fff; }
        .db-checkbox-table td { padding: 8px 16px; }
        .db-checkbox-table label { font-weight: 500; cursor: pointer; }
        .info-card {
            background: #fff; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            margin-bottom: 25px; border-left: 4px solid #418679; overflow: hidden;
        }
        .info-card .card-body-custom { padding: 20px 24px; }
        .info-card h4 { color: #32325d; font-weight: 700; margin-bottom: 15px; }
        .info-card p { margin-bottom: 6px; line-height: 1.8; color: #444; }
    </style>
</head>
<body>
<?php include "../public/header.php" ?>
<style>
    #accordion .panel-heading {
        padding: 0;
        border: none;
        border-radius: 0;
        position: relative;
    }

    #accordion .panel-title a {
        display: block;
        padding: 15px 20px;
        margin: 0;
        background: #fe7725;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        color: #fff;
        border-radius: 0;
        position: relative;
    }

    #accordion .panel-title a.collapsed {
        background: #1c2336;
    }

    #accordion .panel-title a:before,
    #accordion .panel-title a.collapsed:before {
        content: "\f068";
        font-family: fontawesome;
        width: 30px;
        height: 30px;
        line-height: 25px;
        border-radius: 50%;
        background: #fe7725;
        font-size: 14px;
        font-weight: normal;
        color: #fff;
        text-align: center;
        border: 3px solid #fff;
        position: absolute;
        top: 10px;
        right: 14px;
    }

    #accordion .panel-title a.collapsed:before {
        content: "\f067";
        background: #ababab;
        border: 4px solid #626262;
    }

    #accordion .panel-title a:after,
    #accordion .panel-title a.collapsed:after {
        content: "";
        width: 17px;
        height: 7px;
        background: #fff;
        position: absolute;
        top: 22px;
        right: 0;
    }

    #accordion .panel-body {
        border-left: 3px solid #fe7725;
        border-top: none;
        background: #fff;
        font-size: 15px;
        color: #1c2336;
        line-height: 27px;
        position: relative;
    }

    #accordion .panel-body:before {
        content: "";
        height: 3px;
        width: 100%;
        background: #fe7725;
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #80bdff;
        box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
    }

    .select2-container--default .select2-selection--multiple {
        border-radius: 1px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border: none;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        border-right: none;
    }

    .container .btn {
        width: auto;
        margin-top: 5px;
    }

    /*  input */
    .radio input[type="radio"],
    .radio-inline input[type="radio"],
    .checkbox input[type="checkbox"],
    .checkbox-inline input[type="checkbox"] {
        position: relative;
        float: left;
        margin-left: -20px;
    }

    .radio + .radio,
    .checkbox + .checkbox {
        margin-top: -5px
    }

    .radio-inline,
    .checkbox-inline {
        display: inline-block;
        padding-left: 20px;
        margin-bottom: 0;
        font-weight: normal;
        vertical-align: middle;
        cursor: pointer
    }

    .form-control {
        width: 100%;
        height: 35px;
    }

    span > b {
        padding: 0 5px;
    }

    .card {
        margin-left: 10%;
        margin-right: 10%;
    }
</style>
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/"><i class="ri-home-4-line"></i> Home</a> &nbsp;/&nbsp;
            <a href="/ENdb/Analysis/">Analysis</a> &nbsp;/&nbsp;
            <span>Pathway Enrichment</span>
        </div>
        <h1 class="hero-title"><i class="ri-briefcase-4-line"></i> Pathway Enrichment Analysis</h1>
        <p class="hero-subtitle">Pathway enrichment analysis of enhancer-TF targets</p>
    </div>
</div>
<div class="container" style="margin-top:-20px; position:relative; z-index:10;">
    <div class="analysis-card">
        <div class="card-header-custom">
            <i class="ri-briefcase-4-line"></i> Pathway enrichment analysis of enhancer-TF targets
        </div>
        <div class="card-body-custom">
            <div class="row">
                <div class="col-lg-12">
                    <form action="Pathway_enrichment_analysis_result.php" target="_blank"
                          id="form_"
                          method="post">
                        <label class="form-label-custom"><i class="ri-database-2-line"></i> Databases &nbsp;<span style="font-weight:400;font-size:13px;color:#777;">Select All</span> <input type="checkbox" checked="checked" id="all"></label>
                            <table class="table table-bordered db-checkbox-table">
                                <tbody id="list">
                                <tr style="text-align: start;">
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="KEGG"
                                                                              checked="checked">KEGG
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="NetPath"
                                                                              checked="checked">NetPath
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="Reactome"
                                                                              checked="checked">Reactome
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="WikiPathways"
                                                                              checked="checked">WikiPathways
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="PANTHER"
                                                                              checked="checked">PANTHER
                                        </label></td>
                                </tr>
                                <tr style="text-align: start;">
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="PID"
                                                                              checked="checked">PID
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="HumanCyc"
                                                                              checked="checked">HumanCyc
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="CTD"
                                                                              checked="checked">CTD
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="SMPDB"
                                                                              checked="checked">SMPDB
                                        </label></td>
                                    <td><label class="checkbox-inline"><input type="checkbox" name="databases[]"
                                                                              value="INOH"
                                                                              checked="checked">INOH
                                        </label></td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <div>
                                <label class="form-label-custom"><i class="ri-bug-line"></i> Species</label>
                                <div id="species"></div>
                                <label class="form-label-custom"><i class="ri-body-scan-line"></i> Tissue Name</label>
                                <div id="tissue_name"></div>
                                <label class="form-label-custom"><i class="ri-microscope-line"></i> Cell Name</label>
                                <div id="cell_name"></div>
                                <label class="form-label-custom"><i class="ri-dna-line"></i> Enhancer ID</label>
                                <div id="enhancer_id"
                                     onclick="$('#file_check').prop('checked',false);$('#file_').val('');"></div>
                            </div>
                            <script>
                                window.species = new reinput({
                                    name: "species",
                                    target: "#species",
                                    ajax: {
                                        url: "enrichment_server.php?input_sel=Species",
                                    },
                                    api: {
                                        change: function () {
                                            window.species.change(analysis_obj)
                                        }
                                    }
                                });
                                window.tissue_name = new reinput({
                                    name: "tissue_name",
                                    target: "#tissue_name",
                                    ajax: {
                                        url: "enrichment_server.php?input_sel=Tissue",
                                    },
                                    api: {
                                        change: function () {
                                            window.tissue_name.change(analysis_obj)
                                        }
                                    }
                                });
                                window.cell_name = new reinput({
                                    name: "cell_name",
                                    target: "#cell_name",
                                    ajax: {
                                        url: "enrichment_server.php?input_sel=Cell_Source",
                                    },
                                    api: {
                                        change: function () {
                                            window.cell_name.change(analysis_obj)
                                        }
                                    }
                                });
                                window.enhancer_id = new reinput({
                                    name: "enhancer_id",
                                    target: "#enhancer_id",
                                    ajax: {
                                        url: "enrichment_server.php?input_sel=Enhancer_id",
                                    },
                                    api: {
                                        change: function () {
                                            window.enhancer_id.change(analysis_obj)
                                        }
                                    }
                                });
                                let analysis_obj = [window.species, window.tissue_name, window.cell_name, window.enhancer_id]
                            </script>
                            <h5><b>Threshold:</b></h5>
                            <div>
                                <input class="form-control" name="Threshold" id="Threshold" value="0.05">
                                <div>
                                    <input type="checkbox" name="adjust" checked="checked">
                                    <span><b>FDR Adjust</b> <span
                                                title="False discovery rate (FDR) : the corrected p-value."
                                                class="glyphicon glyphicon-question-sign"></span></span>
                                </div>
                            </div>
                            <h5><b>GeneNumber:</b></h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label><b>min-count</b></label>
                                    <input class="form-control" name="min" id="min" value="10">
                                </div>
                                <div class="col-lg-6">
                                    <label><b>max-count</b></label>
                                    <input class="form-control" name="max" id="max" value="500">
                                </div>
                            </div>
                            <br>
                            <button type="button" id="submit_" class="btn-submit-custom"><i class="ri-send-plane-fill"></i> Submit</button>
                            <button type="reset" onclick="
                            window.species.reset(analysis_obj);
                            window.tissue_name.reset(analysis_obj);
                            window.cell_name.reset(analysis_obj);
                            window.enhancer_id.reset(analysis_obj);
                            " class="btn-reset-custom"><i class="ri-refresh-line"></i> Reset
                            </button>
                            <button type="reset"
                                    onclick="setTimeout(function() {
                                    $('#fdr').val(0.05);
                                    $('#all').prop('checked', true);
                                    $('#list :checkbox').prop('checked', true);
                                    $('#Threshold').val(0.05);
                                    window.species.val('human',analysis_obj);
                                    window.tissue_name.val('Cervix',analysis_obj);
                                    window.cell_name.val('HeLa cell',analysis_obj);
                                    window.enhancer_id.val('E_01_0002',analysis_obj);
                                },100)"
                                    class="btn-example-custom"><i class="ri-lightbulb-flash-line"></i> Example
                            </button>
                        </form>
                    <script>
                        $("#submit_").click(function () {
                            var checked = 0;
                            $("#list :checkbox").each(function (i, e) {
                                if (e.checked === true) checked++;
                            });
                            if (checked === 0) {
                                alert("Please select some databases!");
                                return;
                            }
                            if ($("#enhancer_id_ipt").val().trim() === "") {
                                alert("Please input a enhancer id!");
                                return;
                            }
                            document.getElementById("form_").submit();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="info-card">
        <div class="card-body-custom">
            <h4><i class="ri-information-line"></i> Function Introduction</h4>
            <p>If users input an Enhancer ID, ENdb will identify the targets regulated by Enhancer-TF.</p>
            <p><b style="color: #1a5c2a;">1) Databases:</b> Select at least one database of pathways.</p>
            <p><b style="color: #1a5c2a;">2) Enhancer ID:</b> Input an Enhancer ID.</p>
            <p><b style="color: #1a5c2a;">3) Threshold:</b> Set P-Value and FDR thresholds.</p>
            <p><b style="color: #1a5c2a;">4) GeneNumber:</b> Limit the number range of genes in pathways.</p>

        </div>
    </div>
</div>

<?php include "../public/footer.php" ?>
<script>
    $(function () {
        $("#all").click(function () {
            if (this.checked) {
                $("#list :checkbox").prop("checked", true);
            } else {
                $("#list :checkbox").prop("checked", false);
            }
        });
    });
</script>
</body>
</html>
