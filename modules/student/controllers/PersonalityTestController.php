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
class PersonalityTestController extends AccuracyTestController
{
    public function generateAnswers($model)
    {
        $answers = [];

        foreach($model->questionAnswers as $key => $val) {
            $answers[] = [
                'id' => $val->id,
                'label' => $val->answer
            ];
        }

        return $answers;
    }
}