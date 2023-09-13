<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testees_active_test".
 *
 * @property int $id
 * @property int $testees_id
 * @property int $sub_test_class_id
 * @property int $current_test_id
 * @property int $start_time
 * @property int $end_time
 * @property int $is_active 0: No; 1: Yes;
 * @property int $created_at
 * @property int $updated_at
 *
 * @property SubTestClass $subTestClass
 * @property QuestionTest $currentTest
 * @property TesteesData $testees
 */
class BaseTesteesActiveTest extends BaseModel
{
    const IS_INACTIVE = 0;
    const IS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testees_active_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['testees_id', 'sub_test_class_id', 'current_test_id', 'start_time', 'end_time'], 'required'],
            [['testees_id', 'sub_test_class_id', 'current_test_id', 'start_time', 'end_time', 'is_active', 'created_at', 'updated_at'], 'integer'],
            [['sub_test_class_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubTestClass::className(), 'targetAttribute' => ['sub_test_class_id' => 'id']],
            [['current_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionTest::className(), 'targetAttribute' => ['current_test_id' => 'id']],
            [['testees_id'], 'exist', 'skipOnError' => true, 'targetClass' => TesteesData::className(), 'targetAttribute' => ['testees_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'testees_id' => 'Testees ID',
            'sub_test_class_id' => 'Sub Test Class ID',
            'current_test_id' => 'Current Test ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[SubTestClass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubTestClass()
    {
        return $this->hasOne(SubTestClass::className(), ['id' => 'sub_test_class_id']);
    }

    /**
     * Gets query for [[CurrentTest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentTest()
    {
        return $this->hasOne(QuestionTest::className(), ['id' => 'current_test_id']);
    }

    /**
     * Gets query for [[Testees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestees()
    {
        return $this->hasOne(TesteesData::className(), ['id' => 'testees_id']);
    }
}
