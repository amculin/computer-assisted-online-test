<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_answer".
 *
 * @property int $id
 * @property int $question_test_id
 * @property string $answer
 * @property int $is_correct
 * @property int $created_at
 * @property int $updated_at
 *
 * @property QuestionTest $questionTest
 */
class BaseQuestionAnswer extends BaseModel
{
    const IS_CORRECT = 1;
    const IS_INCORRECT = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_test_id', 'answer'], 'required'],
            [['question_test_id', 'is_correct', 'created_at', 'updated_at'], 'integer'],
            [['answer'], 'string', 'max' => 255],
            [['question_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionTest::className(), 'targetAttribute' => ['question_test_id' => 'id']],
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
            'answer' => 'Answer',
            'is_correct' => 'Is Correct',
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
}
