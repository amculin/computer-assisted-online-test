<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TarunaClass;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ClassController implements the CRUD actions for TarunaClass model.
 */
class ClassController extends Controller
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
     * Lists all TarunaClass models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TarunaClass::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        if (is_null($id))
            $model = new TarunaClass();
        else
            $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->logo_file = UploadedFile::getInstance($model, 'logo_file');
            $model->logo = $model->logo_file->name;

            if ($model->upload()) {
                if ($model->isNewRecord)
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil menambahkan kelas baru.');
                else
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil mengubah kelas ' . $model->name . '.');

                $model->save(false);
            } else {
                echo '<pre>';
                print_r($model->getErrors());
            }

            return $this->redirect(['index', 'id' => null]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single TarunaClass model.
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
     * Creates a new TarunaClass model.
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
     * Updates an existing TarunaClass model.
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
     * Deletes an existing TarunaClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        Yii::$app->session->setFlash('success-manage-class', 'Berhasil menghapus kelas ' . $model->name . '.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the TarunaClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TarunaClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TarunaClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
