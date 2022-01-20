<?php
namespace app\modules\student\controllers;

use Yii;
use app\models\QuestionAnswer;
use app\models\QuestionTest;
use app\models\TesteesActiveTest;
use app\models\TesteesAnswer;
use app\models\TesteesScore;
use yii\web\Controller;

/**
 * Accuracy test controller for the `student` module
 */
class AccuracyTestController extends Controller
{
    public $layout = '@app/themes/hyriudsgn/views/layouts/member';

    public function beforeAction($action) {
        $this->enableCsrfValidation = true;
        
        return parent::beforeAction($action);
    }

    public function actionIndex($subTestClassId)
    {
        $activeTest = TesteesActiveTest::findActiveTest(Yii::$app->user->identity->testeesData->id);

        if ($activeTest) {
            if ($activeTest->subTestClass->id != $subTestClassId) {
                $hasAlert = true;
                $alert = "Selesaikan dulu tes yang masih aktif: <b>{$activeTest->subTestClass->name}</b>!";

                return $this->render('index', [
                    'alert' => $alert,
                    'hasAlert' => $hasAlert
                ]);
            }

            if ($activeTest->current_test_id == 0) {
                $hasAlert = true;
                $alert = "Seluruh pertanyaan sudah dijawab!";

                return $this->render('index', [
                    'alert' => $alert,
                    'hasAlert' => $hasAlert
                ]);
            }

            if (time() >= $activeTest->end_time) {
                $hasAlert = true;
                $alert = "Waktu pengerjaan sudah habis!";
                $activeTest->is_active = $activeTest::IS_INACTIVE;
                $activeTest->save();

                return $this->render('index', [
                    'alert' => $alert,
                    'hasAlert' => $hasAlert
                ]);
            }
        } else {
            $inactiveTest = TesteesActiveTest::findInactiveTest($subTestClassId, Yii::$app->user->identity->testeesData->id);

            if ($inactiveTest) {
                $hasAlert = true;
                $alert = "Tes sudah pernah dikerjakan, silakan pilih tes yang lainnya!";

                return $this->render('index', [
                    'alert' => $alert,
                    'hasAlert' => $hasAlert
                ]);
            }
            $activeTest = TesteesActiveTest::createActiveTest($subTestClassId, Yii::$app->user->identity->testeesData->id);
        }

        $model = QuestionTest::findOne($activeTest->current_test_id);
        $timeLimit = $activeTest->end_time - time();
        $session = Yii::$app->session;
        $session->set(md5(Yii::$app->user->identity->username . ' - test'), $activeTest);
 
        return $this->render('index', [
            'hasAlert' => false,
            'alert' => '',
            'model' => $model,
            'timeLimit' => $timeLimit
        ]);
    }

    public function actionGetNext()
    {
        $activeTest = Yii::$app->session[md5(Yii::$app->user->identity->username . ' - test')];
        $answer = TesteesAnswer::createAnswer($activeTest, Yii::$app->request->post('answer'));

        if ($answer) {
            $nextQuestion = QuestionTest::findNextQuestion($activeTest);

            if ($nextQuestion) {
                $model = QuestionTest::findOne($nextQuestion->id);
                $data = [
                    'description' => trim(chunk_split($model->description, 1, ' ')),
                    'question' => trim(chunk_split($model->question, 1, ' ')),
                    'answer_list' => $this->generateAnswers($model)
                ];

                $activeTest->current_test_id = $nextQuestion->id;
                $activeTest->save();
            } else {
                $redirect = Yii::$app->urlManager->createAbsoluteUrl(['/student/score/view', 'id' => $activeTest->sub_test_class_id]);

                if (TesteesScore::createScore($activeTest))
                    $this->deactivateTest();

                $data = [
                    'isCompleted' => true,
                    'redirect' => $redirect
                ];
            }

            return json_encode($data);
        }
    }

    public function deactivateTest()
    {
        Yii::$app->session[md5(Yii::$app->user->identity->username . ' - test')]->is_active = TesteesActiveTest::IS_INACTIVE;
        Yii::$app->session[md5(Yii::$app->user->identity->username . ' - test')]->save();

        Yii::$app->session->remove(md5(Yii::$app->user->identity->username . ' - test'));
    }

    public function generateAnswers($model)
    {
        $answers = '';

        foreach($model->questionAnswers as $key => $val) {
            $answers .= '<div class="custom-control custom-radio radio-mjk mb-2">';
            $answers .= '<input type="radio" id="ASQ ' . $val->answer . ' " name="answer" value="' . $val->id . '" class="custom-control-input" />';
            $answers .= '<label class="custom-control-label" for="ASQ' . $val->answer . '">' . $val->answer . '</label>';
            $answers .= '</div>';
        }

        return $answers;
    }
}