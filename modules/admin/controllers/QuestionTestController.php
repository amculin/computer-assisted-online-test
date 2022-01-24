<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\QuestionTest;
//use app\models\QuestionTest;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ClassController implements the CRUD actions for QuestionTest model.
 */
class QuestionTestController extends Controller
{
    public $layout = '@app/themes/hyriudsgn/views/layouts/member';

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {            
        if ($action->id == 'upload-image') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

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
     * Lists all QuestionTest models.
     * @return mixed
     */
    public function actionIndex($subTestClassId, $id = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => QuestionTest::activeFind($subTestClassId),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        if (is_null($id))
            $model = new QuestionTest();
        else
            $model = $this->findModel($id);
        
        $model->sub_test_class_id = $subTestClassId;
        $model->test_name = $model->subTestClass->name;
        $model->is_correct_answer = $model->isNewRecord ? '' : $model->getCorrectAnswer();

        $answerList = $model->getAnswerList();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->isNewRecord)
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil menambahkan pertanyaan baru.');
                else
                    Yii::$app->session->setFlash('success-manage-class', 'Berhasil mengubah pertanyaan.');

                $model->save(false);
            } else {
                echo '<pre>';
                print_r($model->getErrors());
            }

            return $this->redirect(['index', 'subTestClassId' => $subTestClassId]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'answerList' => $answerList,
            'symbolList' => QuestionTest::getSymbolList()
        ]);
    }

    public function actionUploadImage()
    {
        if (Yii::$app->request->isPost) {
            $logoFile = \yii\web\UploadedFile::getInstanceByName('file');
            $logoFile->saveAs('images/logo/' . $logoFile->baseName . '.' . $logoFile->extension);

            return json_encode(['location' => '/images/logo/' . $logoFile->baseName . '.' . $logoFile->extension]);
        }
    }

    /**
     * Displays a single QuestionTest model.
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
     * Creates a new QuestionTest model.
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
     * Updates an existing QuestionTest model.
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
     * Deletes an existing QuestionTest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        
        Yii::$app->session->setFlash('success-manage-class', 'Berhasil menghapus pertanyaan.');

        return $this->redirect(['index', 'subTestClassId' => $model->sub_test_class_id]);
    }

    /**
     * Finds the QuestionTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionTest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
