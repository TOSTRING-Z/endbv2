<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Contact</title>
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

        /* ===== Contact Body ===== */
        .contact-body { padding-bottom: 2rem; }

        /* ===== Info Card ===== */
        .info-card {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            height: 100%;
        }
        .info-card .card-body { padding: 2rem; }
        .info-card h4 {
            color: #32325d;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .info-card h4 i { color: #418679; }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            padding: 0.7rem 0;
            border-bottom: 1px solid #f1f3f5;
        }
        .info-item:last-child { border-bottom: none; }
        .info-item .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #e8f4f1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #418679;
            font-size: 1rem;
        }
        .info-item .info-text {
            font-size: 0.95rem;
            color: #525f7f;
            line-height: 1.6;
        }
        .info-item .info-text strong {
            display: block;
            font-size: 0.8rem;
            color: #8898aa;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.15rem;
        }

        .info-link {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.6rem 1.5rem;
            background: linear-gradient(135deg, #f0f7f5, #e8f2ef);
            border-radius: 8px;
            color: #418679;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .info-link:hover {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            color: #fff;
            text-decoration: none;
        }

        /* ===== Map Card ===== */
        .map-card {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            height: 100%;
        }
        .map-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 350px;
        }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .page-hero { padding: 1.5rem 0 1.2rem; }
            .page-hero .hero-title { font-size: 1.4rem; }
            .map-card img { min-height: 240px; }
        }
    </style>
</head>

<body>
<?php include "public/header.php" ?>

<!-- ===== Hero Banner ===== -->
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <span>Contact</span>
        </div>
        <h1 class="hero-title"><span class="highlight">Contact</span> Us</h1>
        <p class="hero-subtitle">Get in touch with the ENdb team</p>
    </div>
</div>

<!-- ===== Main Content ===== -->
<div class="container contact-body">
    <div class="row">
        <!-- Contact Info -->
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="info-card">
                <div class="card-body">
                    <h4><i class="fa fa-envelope-o"></i> Get in Touch</h4>

                    <div class="info-item">
                        <div class="info-icon"><i class="fa fa-user"></i></div>
                        <div class="info-text">
                            <strong>Principal Investigator</strong>
                            Chunquan Li, Ph.D.
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fa fa-map-marker"></i></div>
                        <div class="info-text">
                            <strong>Address</strong>
                            School of Medical Informatics, Daqing Campus<br>
                            Harbin Medical University<br>
                            39 Xinyang Road, Daqing 163319, China
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fa fa-phone"></i></div>
                        <div class="info-text">
                            <strong>Phone</strong>
                            86-459-8153035
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fa fa-fax"></i></div>
                        <div class="info-text">
                            <strong>Fax</strong>
                            86-459-8153035
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon"><i class="fa fa-at"></i></div>
                        <div class="info-text">
                            <strong>Email</strong>
                            lcqbio@163.com
                        </div>
                    </div>

                    <a href="http://bio.liclab.net/" target="_blank" class="info-link">
                        <i class="fa fa-external-link mr-1"></i> Learn More About Our Group →
                    </a>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="col-lg-6">
            <div class="map-card">
                <img src="images/map.png.jpg" class="img-fluid" alt="Location Map" />
            </div>
        </div>
    </div>
</div>

<?php include "public/footer.php" ?>
</body>
</html>
