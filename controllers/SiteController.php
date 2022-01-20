<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use app\models\BaseClass;
use app\models\BaseUser;
use app\models\LoginForm;
use app\models\BaseTesteesData;
use app\models\UserRegistration;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /* public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    } */

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /* echo '<pre>';
        //print_r(Yii::$app->user);
        print_r(Yii::$app->user);
        echo '</pre>'; */
        //echo Yii::$app->getSecurity()->generatePasswordHash('qwerty123');

        $this->view->title = 'Taruna Education - Login';

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->type == BaseUser::ADMINISTRATOR)
                return $this->redirect(['/admin/dashboard/index']);
            else
                return $this->redirect(['/student/dashboard/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            /* echo '<pre>';
            //print_r(Yii::$app->user);
            print_r(Yii::$app->user->identity);
            echo '</pre>';
            echo 'aaaa';
            exit(); */
            return $this->redirect(['/student/dashboard/index']);
            //return $this->goBack();
        }

        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionTest()
    {
        $this->layout = 'member';

        $this->view->title = 'Taruna Education - Login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            echo 'aaaa';
            exit();
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays registration page.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        $this->view->title = 'Taruna Education - Registration';

        $userModel      = new UserRegistration();
        $userDataModel  = new BaseTesteesData();

        if ($userModel->load(Yii::$app->request->post()) && $userDataModel->load(Yii::$app->request->post())) {
            $userModel->status = UserRegistration::INACTIVE;

            $isValid = $userModel->validate();
            $isValid = $userDataModel->validate() && $isValid;

            if ($isValid) {
                $userModel->save();
                $userDataModel->user_id = $userModel->id;
                $userDataModel->save();

                foreach ($userModel as $key => $value) {
                    $userModel->$key = '';
                }
                $userModel->password = '';

                foreach ($userDataModel as $key => $value) {
                    $userDataModel->$key = '';
                }

                Yii::$app->session->setFlash('success-registration', 'Selamat! Anda sudah berhasil terdaftar, silakan menunggu proses aktivasi akun oleh Admin.');
            }
        }

        $yearList = [];
        $currentYear = date('Y');

        for ($i = $currentYear ; $i >= ($currentYear - 7); $i--) {
            $yearList[$i] = $i;
        }

        $classModel = BaseClass::find()->all();
        $classList = ArrayHelper::map($classModel, 'id', 'name');

        return $this->render('register', [
            'userModel' => $userModel,
            'userDataModel' => $userDataModel,
            'yearList' => $yearList,
            'classList' => $classList
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
