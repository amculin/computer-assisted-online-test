<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testees_answer".
 *
 * @property int $id
 * @property int $question_test_id
 * @property int $testees_id
 * @property int $answer_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property QuestionTest $questionTest
 * @property TesteesData $testees
 */
class BaseTesteesAnswer extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testees_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_test_id', 'testees_id'], 'required'],
            [['question_test_id', 'testees_id', 'answer_id', 'created_at', 'updated_at'], 'integer'],
            [['question_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionTest::className(), 'targetAttribute' => ['question_test_id' => 'id']],
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
            'question_test_id' => 'Question Test ID',
            'testees_id' => 'Testees ID',
            'answer_id' => 'Answer ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[QuestionTest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionTest()
    {
        return $this->hasOne(QuestionTest::className(), ['id' => 'question_test_id']);
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
