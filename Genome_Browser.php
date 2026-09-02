<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Genome Browser</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php include "public/import.php" ?>
    <style>
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

        .browser-card {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        .browser-card .card-header {
            background: linear-gradient(135deg, #f0f7f5, #e8f2ef);
            padding: 1rem 1.5rem;
            font-weight: 700;
            font-size: 1.05rem;
            color: #32325d;
            border-bottom: 1px solid #dde8e4;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .browser-card .card-body { padding: 1.5rem; }

        .btn-genome {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.7rem 2rem;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.25s;
            box-shadow: 0 2px 8px rgba(65,134,121,0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-genome:hover {
            background: linear-gradient(135deg, #2d6b5f, #1a3c34);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(65,134,121,0.3);
            text-decoration: none;
        }
        .btn-genome-outline {
            background: #fff;
            color: #32325d;
            border: 2px solid #dde8e4;
            border-radius: 8px;
            padding: 0.7rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-genome-outline:hover {
            border-color: #418679;
            color: #1a3c34;
            text-decoration: none;
            background: #f8faf9;
        }
        .btn-genome.active {
            background: linear-gradient(135deg, #1a3c34, #2d6b5f);
            box-shadow: 0 4px 16px rgba(26,60,52,0.4);
        }

        #gbrowse {
            border-radius: 10px;
            border: 1px solid #dde8e4;
            min-height: 700px;
        }

        @media (max-width: 991px) {
            .page-hero { padding: 1.5rem 0 1.2rem; }
            .page-hero .hero-title { font-size: 1.4rem; }
            #gbrowse { height: 500px; }
        }
    </style>
</head>

<body>
<?php include "public/header.php" ?>

<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <span>Genome Browser</span>
        </div>
        <h1 class="hero-title"><span class="highlight">Genome</span> Browser</h1>
        <p class="hero-subtitle">Explore enhancer annotations, genes, and SNPs across human (hg38, hg19) and mouse (mm10, mm39) genomes with JBrowse</p>
    </div>
</div>

<div class="container">
    <div class="browser-card">
        <div class="card-header"><i class="fa fa-globe"></i> Select Genome Assembly</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <a href="javascript:void(0)" onclick="switchGenome('hg38')"
                       class="btn-genome active" id="btn-hg38">
                        <i class="fa fa-globe"></i> Human hg38
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <a href="javascript:void(0)" onclick="switchGenome('hg19')"
                       class="btn-genome-outline" id="btn-hg19">
                        <i class="fa fa-globe"></i> Human hg19
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <a href="javascript:void(0)" onclick="switchGenome('mm10')"
                       class="btn-genome-outline" id="btn-mm10">
                        <i class="fa fa-globe"></i> Mouse mm10
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <a href="javascript:void(0)" onclick="switchGenome('mm39')"
                       class="btn-genome-outline" id="btn-mm39">
                        <i class="fa fa-globe"></i> Mouse mm39
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="browser-card">
        <div class="card-header"><i class="fa fa-map"></i> Genome View</div>
        <div class="card-body p-0">
            <iframe id="gbrowse" name="gbrowse" class="w-100" style="border:0;" height="800"
                    src="http://www.licpathway.net/endb_gb/?config=configs%2Fhg38_config.json&amp;assembly=hg38&amp;loc=chr1:10747-14872&amp;tracks=hg38-ReferenceSequenceTrack,gencode_gene_hg38.sorted.gff,enhancer_hg38.sorted.gff,common_snp.sorted.gff&amp;highlight=chr1:10747-14872&amp;tracklist=true"></iframe>
        </div>
    </div>
</div>

<?php include "public/footer.php" ?>

<script>
var hg38Url = 'http://www.licpathway.net/endb_gb/?config=configs%2Fhg38_config.json&assembly=hg38&loc=chr1:10747-14872&tracks=hg38-ReferenceSequenceTrack,gencode_gene_hg38.sorted.gff,enhancer_hg38.sorted.gff,common_snp.sorted.gff&highlight=chr1:10747-14872&tracklist=true';
var hg19Url = 'http://www.licpathway.net/endb_gb/?config=configs%2Fhg19_config.json&assembly=hg19&loc=chr1:10747-14872&tracks=hg19-ReferenceSequenceTrack,gencode_gene_hg19.sorted.gff,enhancer_hg19.sorted.gff,dnase_hg19.sorted.gff&highlight=chr1:10747-14872&tracklist=true';
var mm10Url = 'http://www.licpathway.net/endb_gb/?config=configs%2Fmm10_config.json&assembly=mm10&loc=chr1:1-20000&tracks=mm10-ReferenceSequenceTrack,gencode_gene_mm10.sorted.gff,enhancer_mm10.sorted.gff,dnase_mm10.sorted.gff&highlight=chr1:1-20000&tracklist=true';
var mm39Url = 'http://www.licpathway.net/endb_gb/?config=configs%2Fmm39_config.json&assembly=mm39&loc=chr1:1-20000&tracklist=true';

function switchGenome(genome) {
    var iframe = document.getElementById('gbrowse');
    var buttons = {
        'hg38': document.getElementById('btn-hg38'),
        'hg19': document.getElementById('btn-hg19'),
        'mm10': document.getElementById('btn-mm10'),
        'mm39': document.getElementById('btn-mm39')
    };
    var urls = {
        'hg38': hg38Url,
        'hg19': hg19Url,
        'mm10': mm10Url,
        'mm39': mm39Url
    };

    iframe.src = urls[genome];

    for (var key in buttons) {
        buttons[key].className = (key === genome) ? 'btn-genome active' : 'btn-genome-outline';
    }
}
</script>
</body>
</html>
