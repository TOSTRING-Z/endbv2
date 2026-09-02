<!DOCTYPE html>
<html>
<head>
    <title>ENdb-Browse</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->


    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <!-- for-gallery-rotation -->
    <script src="js/modernizr.custom.97074.js"></script>
    <script defer src="js/jquery.flexslider.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $('.flexslider').flexslider({
                animation: "slide",
                start: function(slider){
                    $('body').removeClass('loading');
                }
            });
        });
    </script>
    <!-- //FlexSlider -->
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Comfortaa:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900" rel="stylesheet">

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
                        <a class="navbar-brand" href="index.php"><b style="color:red;margin-top:1em;margin-left: 100px; "><i style="color:#ffffff">EN</i>db</b></a>
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="hvr-sweep-to-bottom" ><a href="index.php"><strong>Home</strong></a></li>
                        <li class="hvr-sweep-to-bottom  "><a href="Browse.php"><strong>Browse</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="Search.php"><strong>Search</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="Download.php" ><strong>Download</strong></a></li>
                        <li class="hvr-sweep-to-bottom dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <strong>Genome-Browser</strong>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" style="margin-top: -85px;margin-left: 3px;border-radius: 0;">
                                <li><a href="Genome_Browser.php?type=human&loc=chr1%3A1..249250621&tracks=Helas3H3k27ac%2CHelas3H3k4me3%2CDHS_HeLa-S3%2CEnhancer_ENdb_Human&highlight=chr1%3A0..0">ENdb</a></li>
                                <li><a href="Give_Browser.php?tracks=hg19_NONCODE,hg19_GENCODE,3D_4DGenome_024&coordinate=chr6:31132114-31138451,chr6:31132114-31138451">Give</a></li>
                            </ul>
                        </li>
                        <li class="hvr-sweep-to-bottom"><a href="Submit.php" ><strong>Submit</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="Contact.php" ><strong>Contact</strong></a></li>
                        <li class="hvr-sweep-to-bottom"><a href="Help.php" ><strong>Help</strong></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>
</div>
<!-- //header -->
<div id="give" style="width: 100%;">

<link rel="import" href="http://39.100.246.79:40081/components/chart-controller/chart-controller.html">

<script src="http://39.100.246.79:40081/bower_components/webcomponentsjs/webcomponents-loader.js"></script>
<script type="text/javascript" charset="utf-8" src="http://39.100.246.79:1002/js/jquery-3.4.1.min.js"></script>
<script>
<?php
$tracks = '["'.join('", "',preg_split('/,/',$_GET['tracks'])).'"]';
$coordinate = '["'.join('", "',preg_split('/,/',$_GET['coordinate'])).'"]';
?>
    $("div#give").prepend('<chart-controller style="margin-top:100px;" ref=\'["hg19", "hg19"]\' num-of-subs="2"\n' +
        '                  group-id-list=\'["3D_4DGenome", "3D_OncoBase", "genes"]\'\n' +
        '                  default-track-id-list=\'<?php echo $tracks ?>\'\n' +
        '                  coordinate=\'<?php echo $coordinate ?>\'\n' +
        '                  title-text="GIVE">\n' +
        '</stylechart-controller>')


</script>

</div>

<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</div>
</body>
</html>
