<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\SubTestClass;
use app\models\TestSession;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TestSessionController implements the CRUD actions for TestSession model.
 */
class TestSessionController extends Controller
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
     * Lists all TestSession models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        if (is_null($id)) {
            $model = new TestSession();
        } else {
            $model = $this->findModel($id);
            $model->start_time_picker = $model->getConvertedTime($model->start_time);
            $model->end_time_picker = $model->getConvertedTime($model->end_time);
            $model->sub_test_class = $model->getAssignedTest();
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->isNewRecord) {
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil menambahkan sesi tes baru.');
                } else {
                    Yii::$app->session->setFlash('success-manage-class',
                        'Berhasil mengubah sesi tes ' . $model->session_name . '.');
                }

                $model->save(false);
            } else {
                echo '<pre>';
                print_r(Yii::$app->request->post());
                print_r($model->attributes);
                print_r($model->getErrors());
                exit();
            }

            return $this->redirect(['index', 'id' => null]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => TestSession::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $testList = \yii\helpers\ArrayHelper::map(SubTestClass::getList(), 'id', 'name');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'testList' => $testList,
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing TestSession model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        Yii::$app->session->setFlash('success-manage-class',
            'Berhasil menghapus jenis tes ' . $model->session_name . '.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the TestSession model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestSession the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestSession::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
