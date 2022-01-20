<?php

use app\assets\PublicPageAsset;
use yii\helpers\Html;
use yii\web\View;

PublicPageAsset::register($this);

$this->beginPage();
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title><?= Html::encode($this->title) ?></title>

    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Open Graph data -->
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="" />
    <meta property="og:description" content="1200 pixels x 627 pixels | Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam" />
    <meta property="og:image" content="images/global/meta-images.jpg" />

    <!-- Twitter Card -->
    <meta property="twitter:card" content="" />
    <meta property="twitter:title" content="" />
    <meta property="twitter:description" content="" />
    <meta property="twitter:url" content="" />
    <meta property="twitter:image" content="" />

    <!-- Bar Color : Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000000" />
    <!-- Bar Color : Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000000" />
    <!-- Bar Color : iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000000">

    <!-- ****** begin favicons ****** -->
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicons/favicon-16x16.png" />
    <link rel="manifest" href="images/favicons/site.webmanifest" />
    <link rel="mask-icon" href="images/favicons/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#da532c" />
    <meta name="theme-color" content="#ffffff" />
    <!-- ****** end favicons ****** -->

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>
<body>
	<div class="wrapper">
		<div class="preload-mjk">		
	        <div class="preload-mjk-item">
                <!-- Menggunakan fontawesome -->
                <i class="fas fa-spinner fa-pulse"></i>
                
                <!-- Menggunakan image gif -->
                <!-- <img src="./themes/images/icons/icon-preload-40x40.gif"> -->
            </div>
        </div>
    </div>
    <div class="layout-page-full">
        <?= $content; ?>
    </div>
    <?php $this->endBody() ?>
</body>
<?php
$this->registerJs(
    "$('p.help-block').addClass('text-danger font-weight-normal');",
    View::POS_READY,
    'error-handler'
);
?>
</html>
<?php $this->endPage() ?>