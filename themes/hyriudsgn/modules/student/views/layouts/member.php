<?php

use app\assets\MainAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

//MainAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>TARUNA EDUCATION</title>

    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <!-- Open Graph data -->
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:type" content=""/>
    <meta property="og:description" content="1200 pixels x 627 pixels | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam">
    <meta property="og:image" content="./themes/default/images/global/meta-images.jpg"/>

    <!-- Twitter Card -->
    <meta property="twitter:card" content=""/>
    <meta property="twitter:title" content=""/>
    <meta property="twitter:description" content=""/>
    <meta property="twitter:url" content=""/>
    <meta property="twitter:image" content=""/>

    <!-- Bar Color : Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000000">
    <!-- Bar Color : Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000">
    <!-- Bar Color : iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <!-- begin import register css -->
    <link rel="stylesheet" href="/assets/css/styles.css"/>
    <!-- end import register css -->
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
    <div class="wrapper">
		<div class="preload-mjk">		
            <div class="preload-mjk-item">
                <i class="fas fa-spinner fa-pulse"></i>
            </div>
        </div>
        <noscript>
            <div class="alert alert-danger">
                <span><strong>For full functionality of this site it is necessary to enable JavaScript. </strong> Here are the <a href="http://www.enable-javascript.com/" class="alert-link" target="_blank"> instructions how to enable JavaScript in your web browser</a>.</span>
            </div>
        </noscript>

        <!-- function class active on mainmenu -->

        <header id="headertop">
            <!-- begin.navbar header -->
            <nav class="navbar navbar-expand-lg navbar-light fixed-top flex-row">
                <a href="javascript:void(0);" class="button-sidebar-mainmenu finebody" title="menu">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </a>
                <a class="navbar-brand" href="index.php?pages=home">
                    <img src="/images/dummy/logo.png" alt="" />
                </a>
            </nav>
            <!-- end.navbar header -->
        </header>

        <div class="sidebar-mainmenu-box">
            <div class="sidebar-mainmenu">
                <a href="javascript:void(0);" class="button-sidebar-mainmenu-close finebody" title="close menu">
                    <i class="fas fa-times"></i>
                </a>
                <div class="sidebar-mainmenu-item-box">
                    <ul class="sidebar-mainmenu-item sidebar-mainmenu-item-top">
                        
                        <li class="sub-mainmenu-box myprofilerock-li">
                            <div class="myprofilerock-box">
                                <div class="myprofilerock-head">
                                    <div class="myprofilerock-head-img">
                                        <img src="/images/dummy/img-profile-1.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="myprofilerock-caption">
                                    <h2>Danang Pranoto Setyoaji</h2>
                                    <h4>Peserta</h4>
                                </div>
                            </div>
                        </li>
                        <?php
                        $studentMenuList = [
                            [
                                'name'  => 'Dashboard',
                                'url'   => '/student/dashboard/index'
                            ],
                            [
                                'name'  => 'Tes',
                                'url'   => '/student/test-type/index'
                            ],
                            [
                                'name'  => 'Rekap Nilai',
                                'url'   => '/student/score/index'
                            ]
                        ];

                        foreach ($studentMenuList as $key => $menu) {
                        ?>
                        <li>
                            <a href="<?= Url::toRoute($menu['url']); ?>">
                                <h4><?= strtoupper($menu['name']); ?></h4>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <ul class="sidebar-mainmenu-item sidebar-mainmenu-item-bottom">
                        <li>
                            <a href="<?= Url::toRoute('/site/logout'); ?>" title="keluar">
                                <h4><i class="fas fa-sign-out-alt mr-2"></i> KELUAR</h4>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-mainmenu-bg-overlay finebody"></div>
        </div>

        <div class="layout-page">
		    <div class="section-hero-top"></div>
            <div class="section">
                <div class="container">
                    <?= $content; ?>
                </div>
            </div>
        </div>
		<footer>
            <div class="footer">
                <div class="footer-bottom">
                    <div class="container">
                        <div class="copyright text-center">
                            <p>© 2021 TARUNA EDUCATION. All Rights Reserved. Developed by <a href="https://www.hyriudsgn.com/" target="_blank">hyriudsgn</a> & FIT-FAT</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- begin jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- end jquery -->

    <!-- begin popper js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- end popper js -->

    <!-- begin basic framework engine js -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- end basic framework engine js -->

    <!-- begin jquery extra -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- end jquery extra -->

    <!-- START ADD ON / PLUGINS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <script src="/assets/plugins/equalize-height/src/jquery.equal-heights.js"></script>

    <!-- <script src="/assets/plugins/fancybox/dist/jquery.fancybox.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.1/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="/assets/plugins/masonry-layout/dist/masonry.pkgd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- begin plugin counter -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.min.js"></script>
    <!-- end plugin counter -->

    <!-- END ADD ON / PLUGINS JS -->

    <!-- begin basic js in local -->
    <script src="/assets/js/main.js"></script>
    <!-- <script src="/assets/js/main-form-validation.js"></script> -->
    <!-- end basic js in local -->
    <script>document.title = 'Home | TARUNA EDUCATION';</script>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>