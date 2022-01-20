<?php
namespace app\modules\student\controllers;

use Yii;
use app\models\TesteesScore;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Score test controller for the `student` module
 */
class ScoreController extends Controller
{
    public $layout = '@app/themes/hyriudsgn/views/layouts/member';

    public function actionIndex()
    {
        // build a DB query to get all articles with status = 1
        $query = TesteesScore::find()->where(['testees_data_id' => Yii::$app->user->identity->testeesData->id]);

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 1]);

        // limit the query using the pagination and retrieve the articles
        $model = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'model' => $model,
            //'title' => $title,
            'pagination' => $pagination
        ]);
    }

    public function actionView($id)
    {
        $model = TesteesScore::find()->where([
            'testees_data_id' => Yii::$app->user->identity->testeesData->id,
            'sub_test_class_id' => $id
        ])->one();

        return $this->render('view', ['model' => $model]);
    }
}