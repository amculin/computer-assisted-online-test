<?php

namespace app\modules\student\controllers;

use Yii;
use yii\web\Controller;

/**
 * Dashboard controller for the `student` module
 */
class TestTypeController extends Controller
{
    public $layout = '@app/themes/hyriudsgn/views/layouts/member';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $classData = Yii::$app->user->identity->testeesData->class;

        return $this->render('index', ['classData' => $classData]);
    }
}
