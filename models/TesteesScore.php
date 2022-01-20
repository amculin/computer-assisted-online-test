<?php
namespace app\models;

class TesteesScore extends BaseTesteesScore
{
    public static function createScore($activeTest)
    {
        /* $answers = TesteesAnswer::find()->with([
            'questionTest' => function (\yii\db\ActiveQuery $query) use ($activeTest) {
                $query->andWhere("questionTest.sub_test_class_id = {$activeTest->sub_test_class_id}");
            },
        ])->where([
            'testees_id' => $activeTest->testees_id
        ])->all(); */

        $sql = "SELECT a.answer_id, qa.is_correct, a.created_at FROM testees_answer a 
            JOIN question_test t ON (t.id = a.question_test_id)
            JOIN question_answer qa ON (qa.id = a.answer_id)
            WHERE t.sub_test_class_id = :subTestClassId";
        
        $data = \Yii::$app->db->createCommand($sql, [':subTestClassId' => $activeTest->sub_test_class_id])->queryAll();

        $correct    = 0;
        $answered   = 0;
        $incorrect  = 0;
        foreach ($data as $key => $val) {
            if ($val['is_correct'] == QuestionAnswer::IS_INCORRECT)
                $incorrect++;
            else
                $correct++;

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

        /* echo $model->total_time;
        echo '<pre>';
            print_r($data);
        exit(); */
        if (! $model->save()) {
            echo '<pre>';
            print_r($model->getErrors());
        }
    }
}