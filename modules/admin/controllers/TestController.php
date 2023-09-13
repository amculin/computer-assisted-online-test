<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TestClass;
use app\models\SubTestClass;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ClassController implements the CRUD actions for SubTestClass model.
 */
class TestController extends Controller
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
     * Lists all SubTestClass models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SubTestClass::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (is_null($id))
            $model = new SubTestClass();
        else
            $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->isNewRecord)
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil menambahkan tes baru.');
                else
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil mengubah tes ' . $model->name . '.');

                $model->save(false);
            } else {
                echo '<pre>';
                print_r($model->getErrors());
            }

            return $this->redirect(['index', 'id' => null]);
        }

        $testClassModel = TestClass::find()->all();
        $testClassList = [];

        foreach ($testClassModel as $key => $val) {
            $testClassList[$val->id] = $val->class->name . ' - ' . $val->name;
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'testClassList' => $testClassList
        ]);
    }

    /**
     * Displays a single SubTestClass model.
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
     * Creates a new SubTestClass model.
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
     * Updates an existing SubTestClass model.
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
     * Deletes an existing SubTestClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        Yii::$app->session->setFlash('success-manage-class', 'Berhasil menghapus tes ' . $model->name . '.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubTestClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubTestClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubTestClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
