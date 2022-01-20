<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TesteesScore;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ClassController implements the CRUD actions for TesteesScore model.
 */
class ScoreController extends Controller
{
    public $layout = '@app/themes/hyriudsgn/views/layouts/member';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TesteesScore models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TesteesScore::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionDownload()
    {
        return \moonland\phpexcel\Excel::export([
            'asAttachment' => true,
            'setFirstTitle' => 'Rekap Nilai',
            'models' => TesteesScore::find()->all(), 
            'columns' => [
                [
                    'header' => 'Nama Siswa',
                    'value' => function($model) { return $model->testeesData->full_name; }
                ],
                [
                    'header' => 'Kelas',
                    'value' => function($model) { return $model->testeesData->class->name; }
                ],
                [
                    'header' => 'Nama Tes',
                    'value' => function($model) { return $model->subTestClass->name; }
                ],
                'total_answered',
                'total_correct',
                'total_wrong',
                'total_score',
                [
                    'attribute' => 'total_time',
                    'value' => function ($model) {
                        $hour = floor($model->total_time / 3600);
                        $minute = floor(($model->total_time % 3600) / 60);
                        $second = ($model->total_time %3600) % 60;

                        return str_pad($hour, 2, 0, STR_PAD_LEFT) . ':' . str_pad($minute, 2, 0, STR_PAD_LEFT) . ':' . str_pad($second, 2, 0, STR_PAD_LEFT);
                    }
                ],
            ],
        ]);
    }

    /**
     * Displays a single TesteesScore model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    } */

    /**
     * Creates a new TesteesScore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /* public function actionCreate()
    {
        $model = new BaseClass();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    } */

    /**
     * Updates an existing TesteesScore model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } */

    /**
     * Deletes an existing TesteesScore model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        Yii::$app->session->setFlash('success-manage-class', 'Berhasil menghapus kelas ' . $model->name . '.');

        return $this->redirect(['index']);
    } */

    /**
     * Finds the TesteesScore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TesteesScore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* protected function findModel($id)
    {
        if (($model = TesteesScore::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    } */
}
