<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Download</title>
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

        /* ===== Content Card ===== */
        .content-card {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .content-card .card-body {
            padding: 2rem;
        }
        .section-title {
            color: #32325d;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section-title i { color: #418679; }

        /* ===== Download Table ===== */
        .dl-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .dl-table thead th {
            background: linear-gradient(180deg, #f0f7f5, #e8f2ef);
            color: #32325d;
            font-weight: 700;
            font-size: 0.85rem;
            border-bottom: 2px solid #418679;
            padding: 0.8rem 1.2rem;
        }
        .dl-table thead th:first-child { border-radius: 10px 0 0 0; }
        .dl-table thead th:last-child { border-radius: 0 10px 0 0; }
        .dl-table tbody td {
            padding: 1rem 1.2rem;
            font-size: 0.92rem;
            color: #525f7f;
            border-bottom: 1px solid #f1f3f5;
            vertical-align: middle;
        }
        .dl-table tbody tr:hover { background: #f6fbf9; }
        .dl-table tbody tr:last-child td:first-child { border-radius: 0 0 0 10px; }
        .dl-table tbody tr:last-child td:last-child { border-radius: 0 0 10px 0; }

        .dl-number {
            display: inline-block;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #418679;
            color: #fff;
            text-align: center;
            line-height: 28px;
            font-weight: 700;
            font-size: 0.8rem;
            margin-right: 0.5rem;
        }

        /* ===== Download Button ===== */
        .btn-download {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.55rem 1.5rem;
            font-weight: 600;
            font-size: 0.88rem;
            transition: all 0.25s;
            box-shadow: 0 2px 8px rgba(65,134,121,0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-download:hover {
            background: linear-gradient(135deg, #2d6b5f, #1a3c34);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(65,134,121,0.3);
            text-decoration: none;
        }
        .btn-download i { font-size: 0.85rem; }

        /* ===== Format Table ===== */
        .format-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .format-table thead th {
            background: linear-gradient(180deg, #f8fafb, #f0f4f7);
            color: #32325d;
            font-weight: 700;
            font-size: 0.85rem;
            border-bottom: 2px solid #8898aa;
            padding: 0.7rem 1rem;
        }
        .format-table thead th:first-child { border-radius: 8px 0 0 0; }
        .format-table thead th:last-child { border-radius: 0 8px 0 0; }
        .format-table tbody td {
            padding: 0.55rem 1rem;
            font-size: 0.85rem;
            color: #525f7f;
            border-bottom: 1px solid #f1f3f5;
        }
        .format-table tbody tr:hover { background: #fafcfb; }
        .format-table tbody td:first-child { font-weight: 600; color: #32325d; white-space: nowrap; }

        /* ===== Format Hint ===== */
        .format-hint {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.95rem;
            color: #418679;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.2s;
            margin-bottom: 1.5rem;
        }
        .format-hint:hover { color: #1a3c34; text-decoration: none; }

        /* ===== Collapse Panel ===== */
        .collapse-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            background: #fafcfb;
            margin-top: 1.5rem;
        }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .page-hero { padding: 1.5rem 0 1.2rem; }
            .page-hero .hero-title { font-size: 1.4rem; }
            .content-card .card-body { padding: 1.25rem; }
            .dl-table thead { display: none; }
            .dl-table tbody td {
                display: block;
                padding: 0.6rem 1rem;
            }
            .dl-table tbody td:first-child { font-weight: 600; }
            .dl-table tbody td:last-child { padding-bottom: 1rem; }
        }
    
        /* ===== Category Row ===== */
        .dl-category td {
            background: linear-gradient(135deg, #e8f5f0, #d4ede4) !important;
            color: #1a3c34 !important;
            font-size: 0.95rem;
            padding: 0.7rem 1.2rem !important;
            border-bottom: 2px solid #418679 !important;
        }
</style>
</head>

<body>
<?php include "public/header.php" ?>

<!-- ===== Hero Banner ===== -->
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <span>Download</span>
        </div>
        <h1 class="hero-title"><span class="highlight">Download</span></h1>
        <p class="hero-subtitle">All datasets are provided in tab-delimited (.txt) or comma-delimited (.csv) format. Click "Format Details" below for column descriptions.</p>
    </div>
</div>

<!-- ===== Main Content ===== -->
<div class="container" style="padding-bottom: 2rem;">
    <div class="content-card">
        <div class="card-body">
            <div class="section-title">
                <i class="fa fa-download"></i> Available Datasets
            </div>

                        <table class="dl-table">
                <thead>
                    <tr>
                        <th width="65%">Description</th>
                        <th width="35%">Download</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="dl-category">
                        <td colspan="2"><i class="fa fa-database mr-2"></i><strong>Full Dataset</strong></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">1</span> All 4,831 experimentally confirmed enhancers (complete database)</td>
                        <td><a href="download/enhancer_main.txt" class="btn-download" download="enhancer_main.txt"><i class="fa fa-download"></i> enhancer_main.txt</a></td>
                    </tr>
                    <tr class="dl-category">
                        <td colspan="2"><i class="fa fa-paw mr-2"></i><strong>By Species</strong></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">1</span> Homo sapiens — 3,180 enhancers</td>
                        <td><a href="download/Homo sapiens.csv" class="btn-download" download="Homo sapiens.csv"><i class="fa fa-download"></i> Homo sapiens.csv</a></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">2</span> Mus musculus — 1,588 enhancers</td>
                        <td><a href="download/Mus musculus.csv" class="btn-download" download="Mus musculus.csv"><i class="fa fa-download"></i> Mus musculus.csv</a></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">3</span> Danio rerio — 19 enhancers</td>
                        <td><a href="download/Danio rerio.csv" class="btn-download" download="Danio rerio.csv"><i class="fa fa-download"></i> Danio rerio.csv</a></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">4</span> Drosophila melanogaster — 42 enhancers</td>
                        <td><a href="download/Drosophila melanogaster.csv" class="btn-download" download="Drosophila melanogaster.csv"><i class="fa fa-download"></i> Drosophila melanogaster.csv</a></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">5</span> Rattus norvegicus — 2 enhancers</td>
                        <td><a href="download/Rattus norvegicus.csv" class="btn-download" download="Rattus norvegicus.csv"><i class="fa fa-download"></i> Rattus norvegicus.csv</a></td>
                    </tr>

                    <tr class="dl-category">
                        <td colspan="2"><i class="fa fa-heartbeat mr-2"></i><strong>By Condition</strong></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">1</span> Disease-associated enhancers — 2,113 records</td>
                        <td><a href="download/Disease.csv" class="btn-download" download="Disease.csv"><i class="fa fa-download"></i> Disease.csv</a></td>
                    </tr>
                    <tr>
                        <td><span class="dl-number">2</span> Normal condition enhancers — 2,718 records</td>
                        <td><a href="download/Normal.csv" class="btn-download" download="Normal.csv"><i class="fa fa-download"></i> Normal.csv</a></td>
                    </tr>

                </tbody>
            </table>

            <hr style="border-color: #e9ecef; margin: 2rem 0 1.5rem;">

            <a class="format-hint" data-toggle="collapse" href="#formatDetails" role="button" aria-expanded="false" aria-controls="formatDetails">
                <i class="fa fa-info-circle"></i> Format Details &mdash; View All 26 Columns
                <i class="fa fa-chevron-down ml-1" style="font-size:0.75rem;"></i>
            </a>

            <div class="collapse" id="formatDetails">
                <div class="collapse-card">
                                        <table class="format-table">
                        <thead>
                            <tr>
                                <th width="28%">Column</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Enhancer_id</td><td>Unique enhancer identifier (e.g., E_00001)</td></tr>
                            <tr><td>Year</td><td>Publication year of the article</td></tr>
                            <tr><td>PMID</td><td>PubMed ID of the article</td></tr>
                            <tr><td>Title</td><td>Title of the article</td></tr>
                            <tr><td>Species</td><td>Species — Homo sapiens, Mus musculus, Danio rerio, Drosophila melanogaster, or Rattus norvegicus</td></tr>
                            <tr><td>Genome_Build</td><td>Reference genome version (hg19, hg38, mm9, mm10, danRer11, dm6, rn4)</td></tr>
                            <tr><td>Chromosome</td><td>Chromosome number</td></tr>
                            <tr><td>Start_position</td><td>Start position of the enhancer</td></tr>
                            <tr><td>End_position</td><td>End position of the enhancer</td></tr>
                            <tr><td>TF</td><td>Transcription factor(s) binding the enhancer</td></tr>
                            <tr><td>Target_Gene</td><td>Target gene(s) regulated by the enhancer</td></tr>
                            <tr><td>Enhancer_type</td><td>Enhancer type — Enhancer or Super_Enhancer</td></tr>
                            <tr><td>Regulatory_State</td><td>Regulatory state (Active, Poised, etc.)</td></tr>
                            <tr><td>Condition</td><td>Experimental condition (Disease / Normal)</td></tr>
                            <tr><td>Disease_Name</td><td>Disease name(s) associated</td></tr>
                            <tr><td>MONDO</td><td>MONDO ontology ID for the disease</td></tr>
                            <tr><td>DOID</td><td>Disease Ontology ID</td></tr>
                            <tr><td>Tissue</td><td>Tissue(s) studied</td></tr>
                            <tr><td>Tissue_Ontology_ID</td><td>UBERON ontology ID for the tissue</td></tr>
                            <tr><td>Cell_Source</td><td>Source cell line or sample</td></tr>
                            <tr><td>CVCL_ID</td><td>Cellosaurus ID for the cell line</td></tr>
                            <tr><td>Cell_Type</td><td>Cell type(s) studied</td></tr>
                            <tr><td>Cell_Ontology_ID</td><td>CL ontology ID for the cell type</td></tr>
                            <tr><td>Experiment_Type</td><td>Category of experiments performed</td></tr>
                            <tr><td>High_Throughput_Method</td><td>High-throughput experimental methods</td></tr>
                            <tr><td>Low_Throughput_Method</td><td>Low-throughput experimental methods</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "public/footer.php" ?>
</body>
</html>