<!DOCTYPE html>
<html lang="en">

<head>
    <title>ENdb - Submit</title>
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

        /* ===== Form Cards ===== */
        .submit-body { padding-bottom: 3rem; }
        .submit-body .row { align-items: flex-start; }
        .submit-card {
            background: #fff;
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        .submit-card .card-header {
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
        .submit-card .card-header i { color: #418679; font-size: 1.1rem; }
        .submit-card .card-body { padding: 1.5rem; }

        /* ===== Intro Box ===== */
        .intro-box {
            background: linear-gradient(135deg, #fffdf5, #fff9e6);
            border: 2px dashed #ffc65e;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .intro-box img { max-height: 80px; opacity: 0.8; margin-bottom: 0.75rem; }
        .intro-box h5 {
            color: #32325d;
            font-weight: 700;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        /* ===== Form Controls ===== */
        .submit-card label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #525f7f;
            margin-bottom: 0.35rem;
        }
        .submit-card label .required-dot {
            color: #e06060;
            margin-left: 2px;
        }
        .submit-card .form-control {
            border-radius: 8px;
            border: 1.5px solid #e9ecef;
            padding: 0.6rem 0.9rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            color: #32325d;
        }
        .submit-card .form-control:focus {
            border-color: #418679;
            box-shadow: 0 0 0 3px rgba(65,134,121,0.1);
            outline: none;
        }
        .submit-card .form-control::placeholder {
            color: #bdbdbd;
            font-style: italic;
        }
        .submit-card .form-group { margin-bottom: 1.1rem; }

        /* ===== Buttons ===== */
        .btn-submit {
            background: linear-gradient(135deg, #418679, #2d6b5f);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.6rem 2rem;
            font-weight: 700;
            font-size: 0.92rem;
            transition: all 0.25s;
            box-shadow: 0 2px 8px rgba(65,134,121,0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #2d6b5f, #1a3c34);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(65,134,121,0.3);
        }
        .btn-reset {
            background: #fff;
            color: #8898aa;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 2rem;
            font-weight: 600;
            font-size: 0.92rem;
            transition: all 0.25s;
        }
        .btn-reset:hover {
            background: #f8fafb;
            border-color: #ccc;
            color: #525f7f;
        }
        .btn-group-submit {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        /* ===== Hint Badge ===== */
        .hint-required {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            font-size: 0.82rem;
            color: #8898aa;
        }
        .hint-required .req-badge {
            display: inline-block;
            background: #e06060;
            color: #fff;
            font-size: 0.7rem;
            padding: 0.15rem 0.45rem;
            border-radius: 4px;
            font-weight: 600;
        }

        /* ===== Responsive ===== */
        @media (max-width: 991px) {
            .page-hero { padding: 1.5rem 0 1.2rem; }
            .page-hero .hero-title { font-size: 1.4rem; }
            .submit-card { margin-bottom: 1.5rem; }
        }
    </style>
</head>

<body>
<?php include "public/header.php" ?>

<!-- ===== Hero Banner ===== -->
<div class="page-hero">
    <div class="container">
        <div class="breadcrumb-bg">
            <a href="/ENdb/">Home</a> &nbsp;/&nbsp; <span>Submit</span>
        </div>
        <h1 class="hero-title"><span class="highlight">Submit</span> Your Data</h1>
        <p class="hero-subtitle">Share your experimentally validated enhancer data with the ENdb community</p>
    </div>
</div>

<!-- ===== Main Content ===== -->
<div class="container submit-body">
    <form class="form" action="submit/submit.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-6">
                <div class="intro-box">
                    <img src="images/share.png" alt="Share Data">
                    <h5>
                        If you want to share your data, please fill out the necessary information
                        in the form below and we will add it to ENdb soon. Thank you!
                    </h5>
                </div>

                <div class="submit-card">
                    <div class="card-header">
                        <i class="fa fa-user-circle-o"></i> Submitter Information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" class="form-control" name="user_name" placeholder="Optional">
                        </div>
                        <div class="form-group">
                            <label>E-mail <span class="required-dot">*</span></label>
                            <input type="email" id="user_mail" class="form-control" oninput="check_email(this)" name="user_mail" placeholder="Required — e.g. you@example.com">
                        </div>
                        <div class="form-group">
                            <label>Other Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Optional — any additional notes">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6">
                <div class="submit-card">
                    <div class="card-header">
                        <i class="fa fa-database"></i> Enhancer Information
                    </div>
                    <div class="card-body">
                        <div class="hint-required">
                            <span class="req-badge">Required</span> All fields below must be filled
                        </div>

                        <div class="form-group">
                            <label>Enhancer Symbol <span class="required-dot">*</span></label>
                            <input type="text" id="Enhancer_symbol" class="form-control" oninput="check(this)" name="Enhancer_symbol" placeholder="e.g. ZRS">
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Genome Chr <span class="required-dot">*</span></label>
                                    <input type="text" id="Genome_chr" class="form-control" oninput="check(this)" name="Genome_chr" placeholder="e.g. chr1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Start <span class="required-dot">*</span></label>
                                    <input type="text" id="Start_position" class="form-control" oninput="check(this)" name="Start_position" placeholder="e.g. 1000000">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>End <span class="required-dot">*</span></label>
                                    <input type="text" class="form-control" oninput="check(this)" id="End_position" name="End_position" placeholder="e.g. 2000000">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Biosample Name <span class="required-dot">*</span></label>
                            <input type="text" id="biosample_name" class="form-control" oninput="check(this)" name="biosample_name" placeholder="e.g. HeLa cells">
                        </div>
                        <div class="form-group">
                            <label>Disease <span class="required-dot">*</span></label>
                            <input type="text" id="Disease" class="form-control" oninput="check(this)" name="Disease" placeholder="e.g. Cancer">
                        </div>
                        <div class="form-group">
                            <label>Experiment <span class="required-dot">*</span></label>
                            <input type="text" class="form-control" oninput="check(this)" id="Experiment" name="Experiment" placeholder="e.g. ChIP-seq">
                        </div>

                        <div class="btn-group-submit">
                            <button type="Submit" onclick="return check_all()" class="btn-submit">
                                <i class="fa fa-paper-plane"></i> Submit
                            </button>
                            <button type="Reset" class="btn-reset">
                                <i class="fa fa-refresh"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include "public/footer.php" ?>
</body>
<script>
    var user_mail=document.getElementById("user_mail");
    var Enhancer_symbol=document.getElementById("Enhancer_symbol");
    var Genome_chr=document.getElementById("Genome_chr");
    var Start_position=document.getElementById("Start_position");
    var End_position=document.getElementById("End_position");
    var biosample_name=document.getElementById("biosample_name");
    var Disease=document.getElementById("Disease");
    var Experiment=document.getElementById("Experiment");

    user_mail.setCustomValidity("Please enter a mailbox address!");
    Enhancer_symbol.setCustomValidity("It is necessary!");
    Genome_chr.setCustomValidity("It is necessary!");
    Start_position.setCustomValidity("It is necessary!");
    End_position.setCustomValidity("It is necessary!");
    biosample_name.setCustomValidity("It is necessary!");
    Disease.setCustomValidity("It is necessary!");
    Experiment.setCustomValidity("It is necessary!");
    function check_email(e){
        e.setCustomValidity("");
        if (e.checkValidity() == false)
            e.setCustomValidity("Please enter a mailbox address!");
        else
            e.setCustomValidity("");
    }
    function check(e){
        if (e.value == "")
            e.setCustomValidity("It is necessary!");
        else
            e.setCustomValidity("");
    }
    function check_all(){
        var user_mail=document.getElementById("user_mail");
        var Enhancer_symbol=document.getElementById("Enhancer_symbol");
        var Genome_chr=document.getElementById("Genome_chr");
        var Start_position=document.getElementById("Start_position");
        var End_position=document.getElementById("End_position");
        var biosample_name=document.getElementById("biosample_name");
        var Disease=document.getElementById("Disease");
        var Experiment=document.getElementById("Experiment");

        user_mail.setCustomValidity("");
        Enhancer_symbol.setCustomValidity("");
        Genome_chr.setCustomValidity("");
        Start_position.setCustomValidity("");
        End_position.setCustomValidity("");
        biosample_name.setCustomValidity("");
        Disease.setCustomValidity("");
        Experiment.setCustomValidity("");

        if (user_mail.checkValidity() == false||user_mail.value == "")
            user_mail.setCustomValidity("Please enter a mailbox address!");
        else
            user_mail.setCustomValidity("");
        if (Enhancer_symbol.value == ""){
            Enhancer_symbol.setCustomValidity("It is necessary!");
        }
        else
            Enhancer_symbol.setCustomValidity("");
        if (Genome_chr.value == "")
            Genome_chr.setCustomValidity("It is necessary!");
        else
            Genome_chr.setCustomValidity("");
        if (Start_position.value == "")
            Start_position.setCustomValidity("It is necessary!");
        else
            Start_position.setCustomValidity("");
        if (End_position.value == "")
            End_position.setCustomValidity("It is necessary!");
        else
            End_position.setCustomValidity("");
        if (biosample_name.value == "")
            biosample_name.setCustomValidity("It is necessary!");
        else
            biosample_name.setCustomValidity("");
        if (Disease.value == "")
            Disease.setCustomValidity("It is necessary!");
        else
            Disease.setCustomValidity("");
        if (Experiment.value == "")
            Experiment.setCustomValidity("It is necessary!");
        else
            Experiment.setCustomValidity("");
    }
</script>
</html>
