<?php

namespace app\modules\student\controllers;

use Yii;
use app\models\TestSessionAssignment;
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

        $allowedTest = TestSessionAssignment::getActiveSession($testClassId);

        $query = SubTestClass::find()->where(['id' => $allowedTest, 'status' => SubTestClass::ACTIVE]);

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);

        $model = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $testClass = TestClass::findOne($testClassId);
        
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
