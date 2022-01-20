<?php

namespace app\modules\student\controllers;

use Yii;
use app\models\SubTestClass;
use app\models\TestClass;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Dashboard controller for the `student` module
 */
class SubTestListController extends Controller
{
    public $layout = '@app/themes/hyriudsgn/views/layouts/member';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($testClassId)
    {

        $this->canAccess($testClassId);

        // build a DB query to get all articles with status = 1
        $query = SubTestClass::find()->where(['test_class_id' => $testClassId, 'status' => SubTestClass::ACTIVE]);

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 1]);

        // limit the query using the pagination and retrieve the articles
        $model = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        //$model = SubTestClass::find()->where(['test_class_id' => $testClassId])->all();
        $testClass = TestClass::findOne($testClassId);
        /* echo '<pre>';
        //print_r($classData);
        print_r($model);
        exit(); */
        
        //$model = TestClass::getAllByClass();
        $title = strtoupper('KELAS ' . Yii::$app->user->identity->testeesData->class->name . ' - ' . $testClass->name);

        return $this->render('index', [
            'model' => $model,
            'title' => $title,
            'pagination' => $pagination
        ]);
    }

    public function canAccess($testClassId)
    {
        $classData = Yii::$app->user->identity->testeesData->class;
        $testClass = TestClass::findOne($testClassId);

        if ($testClass) {
            if ($classData->id != $testClass->class_id) {
                echo 'Can not access!';

                exit();
            }
        } else {
            echo 'Not found!';
            exit();
        }
    }
}
