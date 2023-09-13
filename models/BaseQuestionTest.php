<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_test".
 *
 * @property int $id
 * @property int $sub_test_class_id
 * @property string $description
 * @property string $question
 * @property int $status
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property QuestionAnswer[] $questionAnswers
 * @property SubTestClass $subTestClass
 * @property TesteesAnswer[] $testeesAnswers
 */
class BaseQuestionTest extends BaseModel
{
    public $test_name;
    public $answers;
    public $is_correct_answer;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_test_class_id', 'description', 'question', 'answers', 'is_correct_answer'], 'required'],
            [['sub_test_class_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description', 'question'], 'string'],
            [['sub_test_class_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubTestClass::className(), 'targetAttribute' => ['sub_test_class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub_test_class_id' => 'Sub Test Class ID',
            'description' => 'Deskripsi',
            'question' => 'Pertanyaan',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Upated At',
            'test_name' => 'Nama Tes',
            'answers' => 'Jawaban',
            'is_correct_answer' => 'Jawaban yang Benar'
        ];
    }

    /**
     * Gets query for [[QuestionAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionAnswers()
    {
        return $this->hasMany(QuestionAnswer::className(), ['question_test_id' => 'id']);
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
     * Gets query for [[TesteesAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesteesAnswers()
    {
        return $this->hasMany(TesteesAnswer::className(), ['question_test_id' => 'id']);
    }
}
