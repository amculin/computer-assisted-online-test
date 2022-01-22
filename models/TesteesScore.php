<?php
namespace app\models;

class TesteesScore extends BaseTesteesScore
{
    public static function createScore($activeTest)
    {
        $sql = "SELECT a.answer_id, qa.is_correct, a.created_at FROM testees_answer a 
            JOIN question_test t ON (t.id = a.question_test_id)
            JOIN question_answer qa ON (qa.id = a.answer_id)
            WHERE t.sub_test_class_id = :subTestClassId AND a.testees_id = :testeesId";
        
        $data = \Yii::$app->db->createCommand($sql, [
            ':subTestClassId' => $activeTest->sub_test_class_id,
            ':testeesId' => \Yii::$app->user->identity->testeesData->id
        ])->queryAll();

        $correct    = 0;
        $answered   = 0;
        $incorrect  = 0;

        foreach ($data as $key => $val) {
            if ($val['is_correct'] == QuestionAnswer::IS_CORRECT)
                $correct++;
            else
                $incorrect++;

            $answered++;
        }

        $model = new self();
        $model->testees_data_id    = $activeTest->testees_id;
        $model->sub_test_class_id   = $activeTest->sub_test_class_id;
        $model->total_answered      = $answered;
        $model->total_correct       = $correct;
        $model->total_wrong         = $incorrect;
        $model->total_score         = $correct;
        $model->total_time          = end($data)['created_at'] - $activeTest->start_time;

        if (! $model->save()) {
            echo '<pre>';
            print_r($model->getErrors());
        } else
            return true;
    }
}