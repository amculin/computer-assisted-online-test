<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Dashboard controller for the `student` module
 */
class DashboardController extends Controller
{
    public $layout = '@app/themes/hyriudsgn/views/layouts/member';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //print_r(\Yii::$app->user->identity);
        return $this->render('index');
    }
}
