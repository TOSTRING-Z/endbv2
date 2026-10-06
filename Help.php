<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Help</title>
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

        /* ===== Help Body ===== */
        .help-body { padding-bottom: 2rem; }

        /* ===== TOC Card ===== */
        .toc-card {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .toc-card .card-body { padding: 1.8rem 2rem; }
        .toc-card h4 {
            color: #32325d;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .toc-card h4 i { color: #418679; }
        .toc-list {
            list-style: none;
            padding: 0;
            margin: 0;
            columns: 2;
            column-gap: 2rem;
        }
        .toc-list li { margin-bottom: 0.45rem; break-inside: avoid; }
        .toc-list li a {
            color: #418679;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .toc-list li a:hover {
            color: #1a3c34;
            text-decoration: none;
            transform: translateX(3px);
        }
        .toc-list li a .toc-num {
            display: inline-flex;
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #e8f4f1;
            color: #418679;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .toc-sublist {
            list-style: none;
            padding-left: 2rem;
            margin: 0.25rem 0 0.5rem;
        }
        .toc-sublist li { font-size: 0.82rem; }
        .toc-sublist li a { font-weight: 500; color: #8898aa; }
        .toc-sublist li a:hover { color: #418679; }

        /* ===== Section Panel ===== */
        .help-section {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        .help-section .section-header {
            background: linear-gradient(135deg, #f0f7f5, #e8f2ef);
            padding: 1rem 1.5rem;
            font-weight: 700;
            font-size: 1.15rem;
            color: #32325d;
            border-bottom: 1px solid #dde8e4;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .help-section .section-header i { color: #418679; font-size: 1.2rem; }
        .help-section .section-body {
            padding: 1.5rem;
            font-size: 1rem;
            color: #525f7f;
            line-height: 1.7;
        }
        .help-section .section-body p { text-align: justify; margin-bottom: 1rem; }
        .help-section .section-body img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.08);
            margin: 0.75rem 0;
        }
        .help-section .section-body .text-center img { display: inline-block; }

        /* ===== Collapse Button ===== */
        .btn-help-toggle {
            display: block;
            width: 100%;
            max-width: 520px;
            margin: 0.4rem auto;
            background: #fff;
            border: 2px solid #e0e8e5;
            border-radius: 10px;
            padding: 0.7rem 1.2rem;
            font-weight: 600;
            font-size: 0.92rem;
            color: #418679;
            transition: all 0.25s;
            text-align: left;
            cursor: pointer;
        }
        .btn-help-toggle:hover {
            border-color: #418679;
            background: #f6fbf9;
            box-shadow: 0 2px 6px rgba(65,134,121,0.08);
        }
        .btn-help-toggle:focus { outline: none; }
        .btn-help-toggle i.fa-chevron-down {
            float: right;
            transition: transform 0.3s;
            margin-top: 3px;
            color: #8898aa;
        }
        .btn-help-toggle[aria-expanded="true"] i.fa-chevron-down { transform: rotate(180deg); }

        /* ===== Collapse Content ===== */
        .help-collapse-content {
            background: #fafcfb;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 0.5rem;
            font-size: 0.95rem;
            color: #525f7f;
            line-height: 1.7;
            text-align: justify;
        }

        /* ===== Red Highlight ===== */
        .text-accent { color: #e06060; font-weight: 700; font-size: 1.05rem; }

        /* ===== Table ===== */
        .help-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .help-table thead th {
            background: linear-gradient(180deg, #f8fafb, #f0f4f7);
            color: #32325d;
            font-weight: 700;
            font-size: 0.85rem;
            border-bottom: 2px solid #8898aa;
            padding: 0.7rem 1rem;
        }
        .help-table thead th:first-child { border-radius: 8px 0 0 0; }
        .help-table thead th:last-child { border-radius: 0 8px 0 0; }
        .help-table tbody td {
            padding: 0.55rem 1rem;
            font-size: 0.85rem;
            color: #525f7f;
            border-bottom: 1px solid #f1f3f5;
        }
        .help-table tbody tr:hover { background: #fafcfb; }
        .help-table tbody td:first-child { font-weight: 600; color: #32325d; white-space: nowrap; }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .page-hero { padding: 1.5rem 0 1.2rem; }
            .page-hero .hero-title { font-size: 1.4rem; }
            .toc-list { columns: 1; }
            .help-section .section-body { padding: 1rem; }
            .btn-help-toggle { max-width: 100%; }
        }
    </style>
</head>

<body>
<?php include "public/header.php" ?>

<!-- ===== Hero Banner ===== -->
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <span>Help</span>
        </div>
        <h1 class="hero-title"><span class="highlight">Help</span> & Documentation</h1>
        <p class="hero-subtitle">Learn how to use ENdb to explore experimentally validated enhancers</p>
    </div>
</div>

<!-- ===== Main Content ===== -->
<div class="container help-body">
    <div class="row">
        <div class="col-lg-12">

            <!-- ===== Table of Contents ===== -->
            <div class="toc-card">
                <div class="card-body">
                    <h4><i class="fa fa-list-ol"></i> Table of Contents</h4>
                    <ul class="toc-list">
                        <li><a href="#construction"><span class="toc-num">1</span> Database Content &amp; Construction</a></li>
                        <li>
                            <a href="#workflow_but"><span class="toc-num">2</span> Overall Workflow</a>
                            <ul class="toc-sublist">
                                <li><a href="#workflow_but">2.1 Workflow for extracting information</a></li>
                                <li><a href="#method_but">2.2 Self-determined method</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#use"><span class="toc-num">3</span> How to Use ENdb</a>
                            <ul class="toc-sublist">
                                <li><a href="#Browser_but">Browse</a></li>
                                <li><a href="#Search_but">Search</a></li>
                                <li><a href="#Genome-browser_but">Genome Browser</a></li>
                                <li><a href="#Analysis_but">Analysis</a></li>
                                <li><a href="#Submit_but">Submit</a></li>
                                <li><a href="#Download_but">Download</a></li>
                            </ul>
                        </li>
                        <li><a href="#term"><span class="toc-num">4</span> Definitions</a></li>
                        <li><a href="#Development"><span class="toc-num">5</span> Development Environment</a></li>
                    </ul>
                </div>
            </div>

            <!-- ===== Section 1 ===== -->
            <div id="construction" class="help-section">
                <div class="section-header">
                    <i class="fa fa-database"></i> 1. Database Content &amp; Construction
                </div>
                <div class="section-body">
                    <p>The user-friendly interface was provided to search, browse, download and visualize the detailed information.</p>
                    <div class="text-center">
                        <img src="images/help/pipline.svg" class="img-fluid" alt="Pipeline"/>
                    </div>
                </div>
            </div>

            <!-- ===== Section 2 ===== -->
            <div class="help-section">
                <div class="section-header">
                    <i class="fa fa-gears"></i> 2. Overall Workflow &amp; Self-Determined Method
                </div>
                <div class="section-body">

                    <button id="workflow_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#workflow" aria-expanded="false"
                            aria-controls="workflow">
                        <i class="fa fa-sitemap mr-2"></i> 2.1: An overall workflow for extracting the information
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="workflow">
                        <div class="help-collapse-content">
                            <p><strong>i.</strong> Get the accurate location information of the publications (e.g. the figures, text description of location information or SNP loci).</p>
                            <p><strong>ii.</strong> Follow up the cited experimental procedure publications.</p>
                            <p><strong>iii.</strong> The reference genome version was obtained directly according to the data provided in the publications.</p>
                        </div>
                    </div>

                    <br/>

                    <button id="method_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#method" aria-expanded="false"
                            aria-controls="method">
                        <i class="fa fa-calculator mr-2"></i> 2.2: A self-determined method for extracting the information
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="method">
                        <div class="help-collapse-content">
                            <p><strong>i.</strong> The screen resolution is unified and resized the images in the publication as 300%.</p>
                            <p><strong>ii.</strong> The screen pixel values obtained by manual measurement are A, B from the transcription start site respectively. A free software for screen pixel was used to measure the pixel values of A, B and P (<a href="http://www.ucbug.com/soft/113483.html" target="_blank">http://www.ucbug.com/soft/113483.html</a>).</p>
                            <p><strong>iii.</strong> We obtained the start site of target genes from NCBI, and converted the corresponding version of location information by LiftOver in the UCSC browser, then, the formulas (1) and (2) were used to calculate the enhancer region.</p>
                            <p style="color:#418679; font-weight:600;">The start position of enhancer = the start site of target gene ± (A+W/2)/P*xxxb (1)</p>
                            <p style="color:#418679; font-weight:600;">The end position of enhancer = the start site of target gene ± (B-W/2)/P*xxxb (2)</p>
                            <p>The '±' represents downstream or upstream in the start site of target gene.</p>
                            <p><strong>iv.</strong> The region of enhancer is converted into hg19 or mm10 version by LiftOver.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ===== Section 3 ===== -->
            <div id="use" class="help-section">
                <div class="section-header">
                    <i class="fa fa-question-circle"></i> 3. How to Use ENdb?
                </div>
                <div class="section-body">

                    <button id="Browser_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#Browser" aria-expanded="false" aria-controls="Browser">
                        <i class="fa fa-table mr-2"></i> 3.1: Browse
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="Browser">
                        <div class="help-collapse-content">
                            <p>The <strong>Browse</strong> page presents enhancer records in an interactive, sortable table with dynamic sidebar filters. Users can filter by <strong>Species</strong>, <strong>Tissue</strong>, <strong>Cell Type</strong>, <strong>Disease</strong>, and <strong>Experiment</strong> — each with real-time result counts and pagination. Clicking any filter value refreshes both the sidebar statistics and the main table. Each record links to a detailed enhancer view. All matching records are presented in a single table without relevance-based prioritization, listed by ascending Enhancer ID by default and re-sortable via any column header.</p>
                            <img src="images/help/help-browser.png" style="width: 100%;" alt="Browse Help"/>
                        </div>
                    </div>

                    <hr style="border-color:#e9ecef; margin: 0.8rem 0;">

                    <button id="Search_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#Search" aria-expanded="false" aria-controls="Search">
                        <i class="fa fa-search mr-2"></i> 3.2: Search
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="Search">
                        <div class="help-collapse-content">
                            <p>The <strong>Search</strong> page offers multiple search modes: by <strong>Enhancer</strong>, <strong>Target Gene</strong>, <strong>TF</strong>, <strong>Tissue</strong>, <strong>Cell Type</strong>, <strong>Cell Line</strong>, <strong>Disease</strong>, and <strong>Chromosome Region</strong>. Users can also upload a BED file for batch queries. Each mode includes example links and species selection (Human/Mouse). Results are displayed in a sortable DataTable with CSV export support. All matching records are returned in a single table without relevance-based prioritization, listed by ascending Enhancer ID by default and re-sortable via any column header.</p>
                            <img src="images/help/help-search.png" style="width: 100%;" alt="Search Help"/>
                        </div>
                        <hr style="border-color:#e9ecef; margin: 1rem 1.5rem;">
                        <div class="help-collapse-content" style="margin:0.5rem;">
                            <p class="text-accent"><i class="fa fa-info-circle mr-1"></i> Enhancer Details</p>
                            <p>Clicking the <strong>Details</strong> link opens a comprehensive enhancer page showing: basic metadata, target genes with aliases, transcription factors, regulatory state, upstream pathway annotations, an interactive <strong>Enhancer Associated Network</strong> graph, <strong>Overlapping Enhancers</strong> table and network, and gene expression charts across multiple datasets (ENCODE, GTEx, CCLE, TCGA). External links to the ENdb Genome Browser (JBrowse2) and UCSC Genome Browser are provided for each locus, dynamically matching the sample's genome build.</p>
                            <img src="images/help/help-detail.png" style="width: 100%;" alt="Detail Help"/>
                        </div>
                    </div>

                    <hr style="border-color:#e9ecef; margin: 0.8rem 0;">

                    <button id="Genome-browser_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#Genome-browser" aria-expanded="false" aria-controls="Genome-browser">
                        <i class="fa fa-globe mr-2"></i> 3.3: Genome Browser
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="Genome-browser">
                        <div class="help-collapse-content">
                            <p>The <strong>Genome Browser</strong> integrates JBrowse2 to visualize enhancer annotations in their genomic context. Four genome assemblies are supported: <strong>Human hg38</strong>, <strong>Human hg19</strong>, <strong>Mouse mm10</strong>, and <strong>Mouse mm39</strong>. Tracks include reference sequence, gene annotations, experimentally validated enhancers, DNase-seq peaks, and super-enhancer elements. Users can switch assemblies with a single click and explore tracks interactively.</p>
                            <img src="images/help/help-genome-browser.png" style="width: 100%;" alt="Genome Browser"/>
                        </div>
                    </div>

                    <hr style="border-color:#e9ecef; margin: 0.8rem 0;">

                    <button id="Analysis_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#Analysis" aria-expanded="false" aria-controls="Analysis">
                        <i class="fa fa-bar-chart mr-2"></i> 3.4: Analysis
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="Analysis">
                        <div class="help-collapse-content">
                            <p>The <strong>Analysis</strong> module provides two tools:</p>
                            <ol>
                                <li><strong>Pathway Enrichment Analysis</strong> — Performs pathway enrichment on enhancer-associated TF target genes. Filter by <strong>Species</strong>, <strong>Tissue</strong>, <strong>Cell Type</strong>, and <strong>Enhancer ID</strong> using dynamic type-ahead search boxes. Supports 10 pathway databases (KEGG, Reactome, WikiPathways, PANTHER, PID, HumanCyc, CTD, SMPDB, INOH, NetPath).</li>
                                <li><strong>AI-Powered Enhancer Query</strong> — Powered by DeepSeek AI, users can describe what they are looking for in natural language (e.g., "enhancers in brain tissue related to disease") and the AI automatically generates SQL to search the enhancer database. Clickable example queries help users get started quickly.</li>
                            </ol>
                            <p><em>Pathway Enrichment Analysis:</em></p>
                            <img src="images/help/help-analysis.png" style="width: 100%;" alt="Analysis"/>
                            <p style="margin-top:1rem;"><em>AI-Powered Enhancer Query:</em></p>
                            <img src="images/help/help-ai-query.png" style="width: 100%;" alt="AI Query"/>
                        </div>
                    </div>

                    <hr style="border-color:#e9ecef; margin: 0.8rem 0;">

                    <button id="Submit_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#Submit" aria-expanded="false" aria-controls="Submit">
                        <i class="fa fa-paper-plane mr-2"></i> 3.5: Submit
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="Submit">
                        <div class="help-collapse-content">
                            <p>The <strong>Submit</strong> page allows researchers to contribute new experimentally validated enhancer data to ENdb. A structured form collects enhancer metadata, genomic coordinates, target genes, TFs, experimental methods, and publication references. Submitted data will be reviewed and integrated into the database.</p>
                            <img src="images/help/help-submit.png" style="width: 100%;" alt="Submit"/>
                        </div>
                    </div>

                    <hr style="border-color:#e9ecef; margin: 0.8rem 0;">

                    <button id="Download_but" class="btn-help-toggle" type="button"
                            data-toggle="collapse" data-target="#Download" aria-expanded="false" aria-controls="Download">
                        <i class="fa fa-download mr-2"></i> 3.6: Download
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="Download">
                        <div class="help-collapse-content">
                            <p>The <strong>Download</strong> page provides the complete <strong>enhancer_main</strong> dataset for download as a tab-delimited text file. This includes all experimentally validated enhancers with their full metadata (coordinates, species, tissues, cell types, diseases, TFs, target genes, experimental methods, and publication references).</p>
                            <img src="images/help/help-download.png" style="width: 100%;" alt="Download"/>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ===== Section 4 ===== -->
            <div id="term" class="help-section">
                <div class="section-header">
                    <i class="fa fa-book"></i> 4. Explanation of Definitions
                </div>
                <div class="section-body">
                    <p>ENdb database contains <strong>26 columns</strong> separated by tab:</p>
                    <table class="help-table">
                        <thead>
                            <tr>
                                <th>Column Name</th>
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

            <!-- ===== Section 5 ===== -->
            <div id="Development" class="help-section">
                <div class="section-header">
                    <i class="fa fa-code"></i> 5. Development Environment
                </div>
                <div class="section-body">
                    <p class="text-accent"><i class="fa fa-laptop mr-1"></i> Development Environment</p>
                    <p>The current version of ENdb 2.0 is developed using <strong>MySQL 8.0.46</strong> (<a href="http://www.mysql.com" target="_blank">mysql.com</a>) and runs on an <strong>Ubuntu 24.04.1 LTS</strong> Linux-based <strong>Apache 2.4.58</strong> Web server (<a href="http://www.apache.org" target="_blank">apache.org</a>). The server-side scripting is <strong>PHP 8.4.22</strong> (<a href="http://www.php.net" target="_blank">php.net</a>). We designed and built the interactive interface using <strong>Bootstrap v3.3.7</strong> (<a href="https://v3.bootcss.com" target="_blank">v3.bootcss.com</a>) and <strong>JQuery v2.1.1</strong> (<a href="http://jquery.com" target="_blank">jquery.com</a>). We used <strong>ECharts</strong> (<a href="http://echarts.baidu.com" target="_blank">echarts.baidu.com</a>) and <strong>D3</strong> (<a href="https://d3js.org" target="_blank">d3js.org</a>) as graphical visualization frameworks, and <strong>JBrowse</strong> (<a href="http://jbrowse.org" target="_blank">jbrowse.org</a>) is the genome browser framework. We recommend using a modern web browser that supports the HTML5 standard such as <strong>Firefox, Google Chrome, Safari, Opera or IE 9.0+</strong> for the best display.</p>
                    <p>The ENdb database is freely available to the research community using the web link <a href="http://www.licpathway.net/ENdb" style="color:#418679; font-weight:700;">http://www.licpathway.net/ENdb</a>. Users are <strong>not required to register or login</strong> to access features in the database.</p>

                    <hr style="border-color: #e9ecef; margin: 1.2rem 0;">

                    <p class="text-accent"><i class="fa fa-shield mr-1"></i> Material Disclaimer</p>
                    <p>The materials and frameworks used by ENdb are shared by the network and do not contain intellectual property infringement. If there is any infringement, please write to us and we will change it in time.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include "public/footer.php" ?>
</body>
</html>