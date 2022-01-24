<?php
namespace app\models;

class TesteesActiveTest extends BaseTesteesActiveTest
{
    public static function findActiveTest($testeesId)
    {
        return self::find()->where([
            'testees_id'    => $testeesId,
            'is_active'     => self::IS_ACTIVE
        ])->one();
    }
    public static function findInactiveTest($subTestClassId, $testeesId)
    {
        return self::find()->where([
            'testees_id'        => $testeesId,
            'sub_test_class_id' => $subTestClassId,
            'is_active'         => self::IS_INACTIVE
        ])->one();
    }

    public static function createActiveTest($subTestClassId, $testeesId)
    {
        $test = QuestionTest::find()->where(['sub_test_class_id' => $subTestClassId])->one();

        $model = new self();
        $model->testees_id          = $testeesId;
        $model->sub_test_class_id   = $subTestClassId;
        $model->current_test_id     = $test->id;
        $model->start_time          = time();
        $model->end_time            = time() + $test->subTestClass->limit_time;
        $model->is_active           = self::IS_ACTIVE;

        if (! $model->save())
            print_r($model->getErrors());
        else
            return $model;
    }
}