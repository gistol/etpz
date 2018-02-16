<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <title>ETPZ - Тестовое задание</title>
        <!-- FAVICON AND APPLE TOUCH -->    
        <link rel="shortcut icon" href="favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="180x180" href="apple-touch-180x180.png">
        <meta name="msapplication-TileImage" content="mstile.png">
        <!-- FONTS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="/website/static/etpz/assets/bootstrap/css/bootstrap.min.css"> 

        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="/website/static/etpz/assets/fonts/fontawesome/css/font-awesome.min.css">

        <!-- BOILER ICONS -->
        <link rel="stylesheet" href="/website/static/etpz/assets/fonts/boiler-icons/css/boiler-icons.min.css">

        <!-- FANCYBOX -->
        <link rel="stylesheet" href="/website/static/etpz/assets/plugins/fancybox/jquery.fancybox.css">

        <!-- REVOLUTION SLIDER -->
        <link rel="stylesheet" href="/website/static/etpz/assets/plugins/revolutionslider/css/settings.css">
        <link rel="stylesheet" href="/website/static/etpz/assets/plugins/revolutionslider/css/layers.css">
        <link rel="stylesheet" href="/website/static/etpz/assets/plugins/revolutionslider/css/navigation.css">

        <!-- OWL Carousel -->
        <link rel="stylesheet" href="/website/static/etpz/assets/plugins/owl-carousel/owl.carousel.css">

        <!-- YOUTUBE PLAYER -->
        <link rel="stylesheet" href="/website/static/etpz/assets/plugins/ytplayer/css/jquery.mb.ytplayer.min.css">

        <!-- ANIMATIONS -->
        <link rel="stylesheet" href="/website/static/etpz/assets/plugins/animations/animate.min.css">

        <!-- CUSTOM & PAGES STYLE -->
        <link rel="stylesheet" href="/website/static/etpz/assets/css/custom.css">
        <link rel="stylesheet" href="/website/static/etpz/assets/css/pages-style.css">
    </head>
    <body>
        <div id="main-container">
            <!-- HEADER -->
            <header id="header-container">
                <div id="header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- LOGO -->
                                <div id="logo">
                                    <a href="index.html">
                                        <img src="/website/static/etpz/assets/images/logo.png" alt="">
                                    </a>
                                </div><!-- LOGO -->
                            </div><!-- col -->
                            <div class="col-sm-9">
                                <!-- MENU --> 
                                <nav>
                                    <a id="mobile-menu-button" href="#"><i class="fa fa-bars"></i></a>
                                    <?php
                                    $navStartNode = $this->document->getProperty("navigationRoot");
                                    if (!$navStartNode instanceof Document\Page) {
                                        if (Site::isSiteRequest()) {
                                            $site = Site::getCurrentSite();
                                            $navStartNode = $site->getRootDocument();
                                        } else {
                                            $navStartNode = Document::getById(1);
                                        }
                                    }
                                    ?>
                                    <ul class="menu clearfix" id="menu">
                                        <?php $mainNavigation = $this->pimcoreNavigation()->getNavigation($this->document, $navStartNode); ?>
                                        <?php foreach ($mainNavigation as $page) { ?>
                                            <?php /* @var $page Zend\Navigation\Page\Mvc */ ?>
                                            <?php // here need to manually check for ACL conditions ?>
                                            <?php
                                            if (!$page->isVisible() || !$this->navigation()->accept($page)) {
                                                continue;
                                            }
                                            ?>
                                            <li class="<?= $page->getHref() == $this->getHref() ? "active" : '' ?>">
                                                <a class="" href="<?= $page->getHref() ?>">
                                                    <?= $page->getTitle() ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>



                                </nav>

                            </div><!-- col -->
                        </div><!-- row -->
                    </div><!-- container-fluid -->    

                </div><!-- HEADER -->		

            </header><!-- HEADER CONTAINER -->


            <!-- PAGE CONTENT -->
            <?= $this->layout()->content; ?>
            <!-- PAGE CONTENT -->

            <!-- FOOTER -->
            <footer id="footer-container">
                <div id="footer"></div><!-- footer -->
            </footer><!-- FOOTER CONTAINER -->
        </div><!-- MAIN CONTAINER -->


        <!-- SCROLL UP -->
        <a id="scroll-up"><i class="fa fa-angle-up"></i></a>


        <!-- jQUERY -->
        <script src="/website/static/etpz/assets/plugins/jquery/jquery-2.2.0.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="/website/static/etpz/assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- VIEWPORT -->
        <script src="/website/static/etpz/assets/plugins/viewport/jquery.viewport.js"></script>

        <!-- MENU -->
        <script src="/website/static/etpz/assets/plugins/menu/hoverIntent.js"></script>
        <script src="/website/static/etpz/assets/plugins/menu/superfish.js"></script>

        <!-- FANCYBOX -->
        <script src="/website/static/etpz/assets/plugins/fancybox/jquery.fancybox.pack.js"></script>

        <!-- REVOLUTION SLIDER  -->
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/jquery.themepunch.tools.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/jquery.themepunch.revolution.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.carousel.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.kenburn.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.migration.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.parallax.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/revolutionslider/js/extensions/revolution.extension.video.min.js"></script>

        <!-- OWL Carousel -->
        <script src="/website/static/etpz/assets/plugins/owl-carousel/owl.carousel.min.js"></script>

        <!-- DRAG SLIDER -->
        <script src="/website/static/etpz/assets/plugins/dragslider/dragdealer.js"></script>

        <!-- PARALLAX -->
        <script src="/website/static/etpz/assets/plugins/parallax/jquery.stellar.min.js"></script>

        <!-- ISOTOPE -->
        <script src="/website/static/etpz/assets/plugins/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/isotope/isotope.pkgd.min.js"></script>

        <!-- PLACEHOLDER -->
        <script src="/website/static/etpz/assets/plugins/placeholders/jquery.placeholder.min.js"></script>

        <!-- CONTACT FORM VALIDATE & SUBMIT -->
        <script src="/website/static/etpz/assets/plugins/validate/jquery.validate.min.js"></script>
        <script src="/website/static/etpz/assets/plugins/submit/jquery.form.min.js"></script>

        <!-- GOOGLE MAPS -->
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="/website/static/etpz/assets/plugins/googlemaps/gmap3.min.js"></script>

        <!-- CHARTS -->
        <script src="/website/static/etpz/assets/plugins/charts/jquery.easypiechart.min.js"></script>

        <!-- COUNTER -->
        <script src="/website/static/etpz/assets/plugins/counter/jquerysimplecounter.js"></script>

        <!-- YOUTUBE PLAYER -->
        <script src="/website/static/etpz/assets/plugins/ytplayer/jquery.mb.ytplayer.min.js"></script>

        <!-- INSTAFEED -->
        <script src="/website/static/etpz/assets/plugins/instafeed/instafeed.min.js"></script>

        <!-- ANIMATIONS -->
        <script src="/website/static/etpz/assets/plugins/animations/wow.min.js"></script>

        <!-- COUNTDOWN -->
        <script src="/website/static/etpz/assets/plugins/countdown/jquery.countdown.min.js"></script>

        <!-- CUSTOM JS -->
        <script src="/website/static/etpz/assets/js/custom.js"></script>

    </body>

</html>