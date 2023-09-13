<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TarunaClass;
use app\models\TestClass;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ClassController implements the CRUD actions for TestClass model.
 */
class TestClassController extends Controller
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
     * Lists all TestClass models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TestClass::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (is_null($id))
            $model = new TestClass();
        else
            $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                if ($model->isNewRecord)
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil menambahkan jenis tes baru.');
                else
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil mengubah jenis tes ' . $model->name . '.');

                $model->save(false);
            } else {
                echo '<pre>';
                print_r($model->getErrors());
            }

            return $this->redirect(['index', 'id' => null]);
        }

        $classModel = TarunaClass::find()->all();
        $classList = ArrayHelper::map($classModel, 'id', 'name');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'classList' => $classList
        ]);
    }

    /**
     * Displays a single TestClass model.
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
     * Creates a new TestClass model.
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
     * Updates an existing TestClass model.
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
     * Deletes an existing TestClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        Yii::$app->session->setFlash('success-manage-class', 'Berhasil menghapus jenis tes ' . $model->name . '.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the TestClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
