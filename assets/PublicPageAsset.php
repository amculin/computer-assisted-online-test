<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Login page asset bundle for Hyriu Design theme based on Bootstrap 3
 */
class PublicPageAsset extends AssetBundle
{
    public $sourcePath = '@app/themes/hyriudsgn/assets';

    public $css = [
        'css/styles.css',
        'css/typography.css',
        'css/animate-custom.css',
        'css/form-master.min.css',
        'css/general-master.css',
        //'css/general.css',
        'css/responsive-master.css',
        //'css/responsive.css',
        'plugins/animate/animate.min.css',
    ];

    public $js = [
        'js/public-page.js',
        //'js/main-form-validation.js',
    ];

    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
