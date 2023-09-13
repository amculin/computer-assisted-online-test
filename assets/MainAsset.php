<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Login page asset bundle for Hyriu Design theme based on Bootstrap 3
 */
class MainAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/hyriudsgn/assets';

    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css',
        'https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap',
        'https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap',
        'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap',
        'plugins/animate/animate.min.css',
        'plugins/fancybox/dist/jquery.fancybox.min.css',
        'css/typography.css',
        'css/form-master.min.css',
        'css/general-master.min.css',
        'css/navbar.css',
        'css/layout.css',
        'css/responsive-master.min.css',
        'css/responsive-navbar.css',
        'css/responsive.css'
        /* 'css/style.css',
        'plugins/animate/animate.min.css',
        'plugins/select2/dist/css/select2.min.css',
        'plugins/fancybox/dist/jquery.fancybox.min.css',
        'css/typography.css',
        'css/form-master.min.css',
        'css/general-master.min.css',
        'css/navbar.css',
        'css/layout.css',
        'css/responsive-master.min.css',
        'css/responsive-navbar.css',
        'css/responsive.css' */
    ];

    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js',
        'plugins/equalize-height/src/jquery.equal-heights.js',
        'plugins/slick-carousel/slick/slick.min.js',
        'plugins/fancybox/dist/jquery.fancybox.min.js',
        'plugins/masonry-layout/dist/masonry.pkgd.min.js',
        'js/main-page.js',
        /*
        //'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',

        'js/bootstrap.min.js',

        //'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',

        'plugins/select2/dist/js/select2.min.js',

        'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js',

        'plugins/equalize-height/src/jquery.equal-heights.js',
        'plugins/slick-carousel/slick/slick.min.js',
        'plugins/fancybox/dist/jquery.fancybox.min.js',
        'https://cdn.jsdelivr.net/npm/sweetalert2@10.0.1/dist/sweetalert2.all.min.js',
        'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
        'plugins/masonry-layout/dist/masonry.pkgd.min.js',
        'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
        'https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/aos/3.0.0-beta.6/aos.js',
        'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js',
        'https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js',
        'https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js',
        'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js',
        'https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.min.js',
        'js/main-page.js',
        'js/main-form-validation.js', */
    ];

    
    public $depends = [
        'yii\bootstrap4\BootstrapAsset',
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
