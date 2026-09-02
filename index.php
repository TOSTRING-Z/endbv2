<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Home</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <?php include "public/import.php" ?>
    <?php include "public/conn.php" ?>
    <style>
        /* ===== Hero Banner ===== */
        .home-hero {
            background: linear-gradient(135deg, #1a3c34 0%, #2d6b5f 40%, #418679 100%);
            padding: 3.5rem 0 3rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .home-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -15%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: rgba(255,255,255,0.03);
        }
        .home-hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -8%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255,255,255,0.025);
        }
        .home-hero .container {
            position: relative;
            z-index: 1;
        }
        .home-hero .breadcrumb-bg {
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }
        .home-hero .breadcrumb-bg a {
            color: rgba(255,255,255,0.85);
        }
        .home-hero .breadcrumb-bg a:hover {
            color: #fff;
        }
        .hero-title {
            color: #fff;
            font-weight: 700;
            font-size: 2.6rem;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }
        .hero-title .highlight {
            color: #ffc65e;
        }
        .hero-subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 1.15rem;
            font-weight: 400;
            line-height: 1.6;
            max-width: 550px;
            text-align: justify;
        }
        .hero-actions {
            margin-top: 1.75rem;
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        .btn-hero-primary {
            background: #ffc65e;
            color: #1a3c34;
            font-weight: 700;
            padding: 0.7rem 2rem;
            border-radius: 8px;
            border: none;
            font-size: 0.95rem;
            transition: all 0.25s;
            box-shadow: 0 4px 15px rgba(255,198,94,0.3);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-hero-primary:hover {
            background: #ffd98a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,198,94,0.4);
            color: #1a3c34;
            text-decoration: none;
        }
        .btn-hero-outline {
            background: transparent;
            color: #fff;
            font-weight: 600;
            padding: 0.7rem 2rem;
            border-radius: 8px;
            border: 2px solid rgba(255,255,255,0.4);
            font-size: 0.95rem;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-hero-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.7);
            color: #fff;
            text-decoration: none;
        }

        /* ===== Hero Carousel ===== */
        .hero-carousel-wrapper {
            background: rgba(255,255,255,0.06);
            border-radius: 14px;
            padding: 1.25rem;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .hero-carousel-wrapper .carousel-item {
            height: 320px;
            border-radius: 10px;
            overflow: hidden;
            background: #1a3c34;
        }
        .hero-carousel-wrapper .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
        }
        .hero-carousel-wrapper .carousel-indicators {
            bottom: -35px;
        }
        .hero-carousel-wrapper .carousel-indicators li {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            border: none;
        }
        .hero-carousel-wrapper .carousel-indicators .active {
            background: #ffc65e;
        }

        /* ===== Section Headers ===== */
        .section-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .section-header h2 {
            font-weight: 700;
            color: #32325d;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        .section-header .section-line {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #418679, #ffc65e);
            border-radius: 3px;
            margin: 0 auto;
        }
        .section-header p {
            color: #8898aa;
            font-size: 0.95rem;
            margin-top: 0.75rem;
        }

        /* ===== About Section ===== */
        .about-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .about-card .card-body {
            padding: 2.5rem;
        }
        .about-card h3 {
            color: #32325d;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .about-card p {
            color: #525f7f;
            font-size: 1rem;
            line-height: 1.8;
            text-align: justify;
        }

        /* ===== Statistics Top 10 Bar Charts ===== */
        .stats-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: center;
            margin-bottom: 24px;
        }
        .stats-tab {
            padding: 10px 22px;
            border: 2px solid #418679;
            background: #fff;
            color: #418679;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            outline: none;
        }
        .stats-tab:hover {
            background: #e8f5f0;
        }
        .stats-tab.active {
            background: #418679;
            color: #fff;
        }
        .stats-panel {
            display: none;
            animation: fadeSlideIn 0.4s ease;
        }
        .stats-panel.active {
            display: block;
        }
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .bar-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .bar-label {
            width: 200px;
            text-align: right;
            padding-right: 12px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #444;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex-shrink: 0;
        }
        .bar-track {
            flex: 1;
            height: 26px;
            background: #f0f0f0;
            border-radius: 13px;
            overflow: hidden;
            position: relative;
        }
        .bar-fill {
            height: 100%;
            border-radius: 13px;
            transition: width 0.8s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 10px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #fff;
            min-width: 40px;
        }
        .bar-fill.c1 { background: linear-gradient(90deg, #5b9bd5, #3a7cc3); }
        .bar-fill.c2 { background: linear-gradient(90deg, #418679, #2d6b5f); }
        .bar-fill.c3 { background: linear-gradient(90deg, #8e6cab, #6c4f8a); }
        .bar-fill.c4 { background: linear-gradient(90deg, #f0a04b, #d4852f); }
        .bar-fill.c5 { background: linear-gradient(90deg, #e06060, #c44040); }
        .bar-fill.c6 { background: linear-gradient(90deg, #d47eaa, #b85d8a); }
        .bar-fill.c7 { background: linear-gradient(90deg, #4dbbc4, #3099a1); }
        .bar-fill.c8 { background: linear-gradient(90deg, #7db85c, #5f9a3f); }
        .bar-fill.c9 { background: linear-gradient(90deg, #a07a5a, #835d3e); }
        .bar-fill.c10 { background: linear-gradient(90deg, #6b7f9e, #4e6382); }
        @media (max-width: 768px) {
            .bar-label { width: 120px; font-size: 0.75rem; }
            .stats-tab { padding: 8px 14px; font-size: 0.78rem; }
        }


/* ===== Sister Projects ===== */
        .sister-card {
            border: none;
            border-radius: 12px;
            padding: 1.5rem;
            height: 100%;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: all 0.3s;
            border-left: 4px solid #418679;
        }
        .sister-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        .sister-card .sister-name {
            font-weight: 700;
            font-size: 1rem;
            color: #32325d;
            margin-bottom: 0.3rem;
        }
        .sister-card .sister-name a {
            color: #418679;
            transition: color 0.2s;
        }
        .sister-card .sister-name a:hover {
            color: #1a3c34;
            text-decoration: none;
        }
        .sister-card .sister-desc {
            color: #8898aa;
            font-size: 0.88rem;
        }

        /* ===== Page Sections ===== */
        .page-section {
            padding: 2rem 0;
        }
        .page-section.alt-bg {
            background: #f8fafb;
            margin: 2rem 0;
            padding: 3rem 0;
        }

        /* ===== Footer CTA ===== */
        .cta-banner {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            border-radius: 16px;
            padding: 2.5rem;
            text-align: center;
            color: #fff;
            margin-top: 1rem;
        }
        .cta-banner h3 {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .cta-banner p {
            opacity: 0.85;
            max-width: 600px;
            margin: 0 auto 1.5rem;
            font-size: 0.95rem;
        }
        .cta-banner .btn-hero-primary {
            background: #ffc65e;
            color: #1a3c34;
        }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .home-hero {
                padding: 2rem 0 1.5rem;
            }
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-subtitle {
                font-size: 0.95rem;
            }
            .hero-carousel-wrapper {
                margin-top: 1.5rem;
            }
            .hero-carousel-wrapper .carousel-item {
                height: 220px;
            }
            .stat-card {
                margin-bottom: 0.5rem;
            }
            .stat-card .stat-number {
                font-size: 1.7rem;
            }
            .about-card .card-body {
                padding: 1.5rem;
            }
            .cta-banner {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <?php include "public/header.php" ?>

    <!-- ===== Hero Banner ===== -->
    <div class="home-hero">
        <div class="container">
            <div class="breadcrumb-bg">
                <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <span>Welcome</span>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">ENdb 2.0</h1>
                    <p class="hero-subtitle">Enhancers are distal cis-regulatory elements that drive lineage-specific transcription. Enhancers are essential for normal tissue and cell development. They also show strict disease, tissue, and cell-type specificity. Here, we present ENdb 2.0, an updated database built for specific diseases, tissues, cell types, cell lines, and exact validation experiments of enhancers.</p>
                    <div class="hero-actions">
                        <a href="Analysis/Enhancer_AI_Query.php" class="btn-hero-primary"><i class="fa fa-magic"></i> Enhancer AI Query</a>
                        <a href="Browse.php" class="btn-hero-outline"><i class="fa fa-database"></i> Data Browser</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-carousel-wrapper">
                        <div id="homeCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                $carouselPath = "images/home/";
                                $carouselFiles = [];
                                if (is_dir($carouselPath)) {
                                    $handler = opendir($carouselPath);
                                    while (($filename = readdir($handler)) !== false) {
                                        if ($filename != "." && $filename != "..") {
                                            $carouselFiles[] = $filename;
                                        }
                                    }
                                    closedir($handler);
                                }
                                foreach ($carouselFiles as $i => $val) {
                                    $activeClass = $i == 0 ? ' class="active"' : '';
                                    echo "<li data-target=\"#homeCarousel\" data-slide-to=\"$i\"$activeClass></li>";
                                }
                                ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php foreach ($carouselFiles as $i => $val) { ?>
                                    <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
                                        <img class="d-block w-100" src="<?php echo $carouselPath . $val; ?>" alt="ENdb screenshot">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== About Section ===== -->
    <div class="container page-section">
        <div class="section-header">
            <h2>What is ENdb?</h2>
            <div class="section-line"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card about-card">
                    <div class="card-body">
                        <h3><i class="fa fa-magic mr-2" style="color:#418679;"></i>A Manually Curated Enhancer Knowledge Base</h3>
<p>
                            Here, we present <strong>ENdb 2.0</strong> (<a href="http://www.licpathway.net/ENdb/index.php" target="_blank" style="color:#418679;">http://www.licpathway.net/ENdb/index.php</a>), a major update developed to systematically catalog manually curated and experimentally validated enhancers. In ENdb 2.0, we provide 3,523 enhancers validated by biological experiments (a 4.8-fold expansion over version 1.0). Through an article-by-article manual review of full-text literature, we have cataloged enhancers across 1,192 cell lines (a 7.5-fold increase), 66 tissues (a 3.0-fold increase), 112 diseases (a 2.5-fold increase), and 148 cell types (a 1.4-fold increase), ensuring every single genomic coordinate is rigorously backed by manually verified functional assays reported in the original literature. Furthermore, species coverage has expanded from two mammalian models to five phylogenetically diverse species: Homo sapiens, Mus musculus, Danio rerio, Drosophila melanogaster, and Gallus gallus.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

                <!-- ===== Statistics Section ===== -->
    <div class="page-section alt-bg">
        <div class="container">
            <div class="section-header">
                <h2><i class="fa fa-bar-chart mr-2" style="color:#418679;"></i>Statistics</h2>
                <div class="section-line"></div>
                <p>Top 10 rankings of ENdb 2.0</p>
            </div>

            <!-- Tab Navigation -->
                        <div class="stats-tabs">
                <button class="stats-tab active" onclick="switchStatsTab('disease')"><i class="fa fa-medkit mr-1"></i>Disease</button>
                <button class="stats-tab" onclick="switchStatsTab('tissue')"><i class="fa fa-heartbeat mr-1"></i>Tissue</button>
                <button class="stats-tab" onclick="switchStatsTab('cell')"><i class="fa fa-eyedropper mr-1"></i>Cell Type</button>
                <button class="stats-tab" onclick="switchStatsTab('tf')"><i class="fa fa-cogs mr-1"></i>TF</button>
                <button class="stats-tab" onclick="switchStatsTab('gene')"><i class="fa fa-dot-circle-o mr-1"></i>Target Gene</button>
            </div>

<?php
$stats_categories = [
    'disease' => ['label' => 'Disease', 'icon' => 'fa-medkit', 'column' => 'Disease_Name', 'active' => ' active'],
    'tissue' => ['label' => 'Tissue', 'icon' => 'fa-heartbeat', 'column' => 'Tissue', 'active' => ''],
    'cell' => ['label' => 'Cell Type', 'icon' => 'fa-eyedropper', 'column' => 'Cell_Type', 'active' => ''],
    'tf' => ['label' => 'TF', 'icon' => 'fa-cogs', 'column' => 'TF', 'active' => ''],
    'gene' => ['label' => 'Target Gene', 'icon' => 'fa-dot-circle-o', 'column' => 'Target_Gene', 'active' => ''],
];
foreach ($stats_categories as $sid => $scat) {
    $col = $scat['column'];
    $sql = "SELECT `{$col}` AS name, COUNT(*) AS cnt FROM enhancer_main WHERE `{$col}` IS NOT NULL AND `{$col}` != '' AND `{$col}` NOT LIKE '%None%' AND `{$col}` NOT LIKE '%none%' GROUP BY `{$col}` ORDER BY cnt DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $max_val = $rows[0]['cnt'] ?? 1;
?>
            <div class="stats-panel<?php echo $scat['active']; ?>" id="panel-<?php echo $sid; ?>">
<?php foreach ($rows as $i => $row):
    $pct = round($row['cnt'] / $max_val * 100, 1);
    $ci = ($i % 10) + 1;
    $name = htmlspecialchars($row['name']);
    $disp = strlen($name) > 28 ? substr($name, 0, 26) . '..' : $name;
?>
                    <div class="bar-item">
                        <span class="bar-label" title="<?php echo $name; ?>"><?php echo $disp; ?></span>
                        <div class="bar-track">
                            <div class="bar-fill c<?php echo $ci; ?>" style="width:<?php echo $pct; ?>%"><?php echo $row['cnt']; ?></div>
                        </div>
                    </div>
<?php endforeach; ?>
            </div>
<?php } ?>
            </div>
        </div>
    </div>

        <!-- ===== Visual Overview ===== -->
    <div class="container page-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm" style="border: none; border-radius: 14px; overflow: hidden;">
                    <div class="card-body p-0">
                        <img src="images/main.png" style="width: 100%;" class="img-fluid" alt="ENdb Overview" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-center">
                <div style="text-align: center; width: 100%;">
                    <script type="text/javascript" src="//rf.revolvermaps.com/0/0/7.js?i=5f4kokbcec6&amp;m=0&amp;c=ff0000&amp;cr1=ffffff&amp;br=2&amp;sx=0" async="async"></script>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Sister Projects ===== -->
    <div class="container page-section">
        <div class="section-header">
            <h2><i class="fa fa-link mr-2" style="color:#418679;"></i>Sister Projects</h2>
            <div class="section-line"></div>
            <p>Explore related databases developed by our team</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="sister-card">
                    <div class="sister-name">
                        <i class="fa fa-thumbs-up mr-1" style="color:#418679;"></i>
                        <a href="http://www.licpathway.net/TF-Marker/" target="_blank">TF-Marker</a>
                    </div>
                    <div class="sister-desc">TF-Marker database for human transcription factor markers</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="sister-card">
                    <div class="sister-name">
                        <i class="fa fa-thumbs-up mr-1" style="color:#418679;"></i>
                        <a href="http://tcof.liclab.net/TcoFbase/" target="_blank">TcoFbase</a>
                    </div>
                    <div class="sister-desc">Documenting a large number of available resources of mammalian transcription co-factors</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="sister-card">
                    <div class="sister-name">
                        <i class="fa fa-thumbs-up mr-1" style="color:#418679;"></i>
                        <a href="http://www.licpathway.net/sedb" target="_blank">SEdb</a>
                    </div>
                    <div class="sister-desc">SEdb: The comprehensive human Super-Enhancer database</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== CTA Banner ===== -->
    <div class="container page-section">
        <div class="cta-banner">
            <h3><i class="fa fa-rocket mr-2"></i>Ready to Explore Enhancers?</h3>
            <p>Search our database of experimentally validated enhancers.</p>
            <a href="Search.php" class="btn-hero-primary"><i class="fa fa-search mr-1"></i> Go to Search</a>
        </div>
    </div>

    <?php include "public/footer.php" ?>

    <script>
        $('#homeCarousel').carousel({ interval: 3000 });
    </script>


    <!-- Stats Tab Switcher -->
    <script>
    function switchStatsTab(tab) {
        document.querySelectorAll('.stats-tab').forEach(function(btn){ btn.classList.remove('active'); });
        document.querySelectorAll('.stats-panel').forEach(function(p){ p.classList.remove('active'); });
        document.querySelector('.stats-tab[onclick*="' + tab + '"]').classList.add('active');
        document.getElementById('panel-' + tab).classList.add('active');
    }
    </script>

</body>
</html>
