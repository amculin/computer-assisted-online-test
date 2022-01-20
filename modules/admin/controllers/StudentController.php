<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\BaseUser;
use app\models\TarunaClass;
use app\models\TesteesData;
use app\models\User;
use app\models\UserRegistration;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * StudentController implements the CRUD actions for TesteesData model.
 */
class StudentController extends Controller
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
                    'activate' => ['POST'],
                    'deactivate' => ['POST']
                ],
            ],
        ];
    }

    /**
     * Lists all TesteesData models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TesteesData::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (is_null($id)) {
            $model = new UserRegistration(['scenario' => UserRegistration::CREATE_USER]);
            $dataModel = new TesteesData();
        } else {
            $model = $this->findModel($id);
            $model->scenario = UserRegistration::UPDATE_USER;
            $dataModel = $this->findDataModel($id);
        }

        if ($model->load(Yii::$app->request->post()) && $dataModel->load(Yii::$app->request->post())) {
            $isValid = $model->validate();
            $isValid = $dataModel->validate() && $isValid;

            if ($isValid) {
                if ($model->isNewRecord)
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil menambahkan siswa baru.');
                else
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil mengubah data siswa: ' . $dataModel->full_name . '.');

                $model->save(false);
                
                $dataModel->user_id = $model->id;
                $dataModel->save(false);
            } else {
                echo '<pre>';
                print_r($model->getErrors());
                print_r($dataModel->getErrors());
            }

            return $this->redirect(['index', 'id' => null]);
        }

        $yearList = [];
        $currentYear = date('Y');

        for ($i = $currentYear ; $i >= ($currentYear - 7); $i--) {
            $yearList[$i] = $i;
        }

        $classModel = TarunaClass::find()->all();
        $classList = ArrayHelper::map($classModel, 'id', 'name');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'dataModel' => $dataModel,
            'yearList' => $yearList,
            'classList' => $classList
        ]);
    }

        /**
     * Lists all TesteesData models.
     * @return mixed
     */
    public function actionChangePassword($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TesteesData::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $model = $this->findModel($id);
        $model->scenario = UserRegistration::CHANGE_PASSWORD;

        if ($model->load(Yii::$app->request->post())) {
            $isValid = $model->validate();

            if ($isValid) {
                Yii::$app->session->setFlash('success-manage-class', 'Berhasil mengubah password untuk ' . $model->email . '.');

                $model->save(false);
            } else {
                echo '<pre>';
                print_r($model->getErrors());
            }

            return $this->redirect(['index', 'id' => null]);
        }

        return $this->render('change-password', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single TesteesData model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TesteesData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TesteesData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TesteesData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TesteesData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing TesteesData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeactivate($id)
    {
        $model = $this->findModel($id);
        $model->status = BaseUser::INACTIVE;
        $model->save(false);

        Yii::$app->session->setFlash('success-manage-class', 'Berhasil menonaktifkan siswa: ' . $model->testeesData->full_name . '.');

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing TesteesData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);
        $model->status = BaseUser::ACTIVE;
        $model->save(false);

        Yii::$app->session->setFlash('success-manage-class', 'Berhasil mengaktifkan siswa: ' . $model->testeesData->full_name . '.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the TesteesData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TesteesData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findDataModel($id)
    {
        if (($model = TesteesData::find()->where(['user_id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the UserRegistration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserRegistration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserRegistration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
