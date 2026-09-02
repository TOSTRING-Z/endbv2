<!DOCTYPE html>
<html>
<head>
    <title>ENdb-Home</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/main.css" rel="stylesheet" type="text/css" />
    <!-- js -->
    <script src="../js/jquery-1.11.1.min.js"></script>
    <!-- for-gallery-rotation -->
    <script src="../js/modernizr.custom.97074.js"></script>
    <!-- //for-gallery-rotation -->
    <!-- FlexSlider -->
    <link rel="stylesheet" href="../css/flexslider.css" type="text/css" media="screen" />
    <script defer src="../js/jquery.flexslider.js"></script>
</head>
<body>

<!-- header -->
<div class="header">
    <div class="container">
        <div class="header-nav">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo">
                        <a class="navbar-brand" href="../index.php"><b style="color:red;margin-top:1em "><i style="color:#ffffff">EN</i>db</b></a>
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="hvr-sweep-to-bottom"><a href="../index.php"><strong>Home</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="../Browse.php"><strong>Browse</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="../Search.php"><strong>Search</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="../Download.php" ><strong>Download</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="../Genome_Browser.php" ><strong>Genome-Browser</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="../Submit.php" ><strong>Submit</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="../Contact.php" ><strong>Contact</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="../Help.php" ><strong>Help</strong></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>
<!-- //header -->

<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
include '../../sqlconfig/ENdb/conn.php';

$Enhancer_symbol=empty($_POST['Enhancer_symbol'])?null:trim($_POST['Enhancer_symbol']);
$Genome_chr=empty($_POST['Genome_chr'])?null:trim($_POST['Genome_chr']);
$Start_position=empty($_POST['Start_position'])?null:trim($_POST['Start_position']);
$biosample_name=empty($_POST['biosample_name'])?null:trim($_POST['biosample_name']);

$End_position=empty($_POST['End_position'])?null:trim($_POST['End_position']);
$Disease=empty($_POST['Disease'])?null:trim($_POST['Disease']);
$Experiment=empty($_POST['Experiment'])?null:trim($_POST['Experiment']);

$user_name=empty($_POST['user_name'])?null:trim($_POST['user_name']);
$user_mail=empty($_POST['user_mail'])?null:trim($_POST['user_mail']);
$description=empty($_POST['description'])?null:trim($_POST['description']);

$submit_sample_sql='INSERT INTO submit
			(Enhancer_symbol,Genome_chr,Start_position,biosample_name,End_position,Disease,Experiment,user_name,user_mail,description)
			values ("'.$Enhancer_symbol.'","'.$Genome_chr.'","'.$Start_position.'","'.$biosample_name.'","'.$End_position.'","'.$Disease.'","'.$Experiment.'","'.$user_name.'","'.$user_mail.'","'.$description.'")';
mysqli_query($conn,$submit_sample_sql);
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-offset-6">
            <ol class="breadcrumb text-right" style="background-color:#ffffff;">
                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                <li><a href="submit.php">Submit</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-md-offset-1" style="height:700px;">
            <center>
                <h1>Submitted successfully</h1>
                <h3>Thank you for the data submitted, we need to review before we can pass.</h3>
                <img src="../images/thank.png" height="500px" width="700px">
            </center>
        </div>

    </div>
</div>
<!-- for bootstrap working -->
<script src="../js/bootstrap.js"> </script>
<!-- //for bootstrap working -->
<!-- footer -->

<div class="copy">
    <div class="container">

        <div class="clearfix">

            <p><a href="../index.php">Home</a> | <a href="../Browse.php">Browse</a> | <a href="../Search.php">Search</a> | <a href="../Download.php">Download</a>  | <a href="../Genome_Browser.php">Genome-Browser</a> | <a href="../Submit.php">Submit</a> | <a href="../Contact.php">Contact</a> | <a href="../Help.php">Help</a>
            <p>Copyright &copy; HMU | <a href="http://www.licpathway.net//" target="_blank"><font size="4" color="red">Li C Lab</a></a></p>
        </div>
    </div>
</div>
<!--//footer-->
</body>
</html>
