<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_test_class".
 *
 * @property int $id
 * @property int $test_class_id
 * @property string $name
 * @property string $description
 * @property int $type 1 = Radio List; 2 = Checkbox List
 * @property int $limit_time
 * @property int $number_of_question
 * @property int $status 0 = Inactive; 1 = Active;
 * @property int $created_at
 * @property int $updated_at
 *
 * @property QuestionTest[] $questionTests
 * @property TestClass $testClass
 */
class BaseSubTestClass extends BaseModel
{
    /**
     * Constant value for status column
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;
    
    const ACCURACY_TEST = 1;
    const SMART_TEST = 2;
    const PERSONALITY_TEST = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_test_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_class_id', 'name', 'description', 'limit_time'], 'required'],
            [['test_class_id', 'type', 'limit_time', 'number_of_question', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 48],
            [['test_class_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestClass::className(), 'targetAttribute' => ['test_class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_class_id' => 'Jenis Tes',
            'name' => 'Nama',
            'description' => 'Deskripsi',
            'type' => 'Tipe',
            'limit_time' => 'Batas Waktu',
            'number_of_question' => 'Jumlah Soal',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[QuestionTests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionTests()
    {
        return $this->hasMany(BaseQuestionTest::className(), ['sub_test_class_id' => 'id']);
    }

    /**
     * Gets query for [[TestClass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestClass()
    {
        return $this->hasOne(BaseTestClass::className(), ['id' => 'test_class_id']);
    }
}
