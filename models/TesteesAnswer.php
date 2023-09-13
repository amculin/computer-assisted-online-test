<?php
namespace app\models;

class TesteesAnswer extends BaseTesteesAnswer
{
    public static function createAnswer($activeTest, $answer)
    {
        $model = new self();
        $model->question_test_id    = $activeTest->current_test_id;
        $model->testees_id          = $activeTest->testees_id;
        $model->answer_id           = $answer;

        if ($model->save())
            return $model;
        else
            print_r($model->getErrors());
    }
}