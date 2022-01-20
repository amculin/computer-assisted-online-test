<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testees_score".
 *
 * @property int $id
 * @property int $testees_data_id
 * @property int $sub_test_class_id
 * @property int $total_answered
 * @property int $total_correct
 * @property int $total_wrong
 * @property int $total_score
 * @property int $total_time
 * @property int $created_at
 * @property int $updated_at
 *
 * @property SubTestClass $subTestClass
 * @property TesteesData $testeesData
 */
class BaseTesteesScore extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testees_score';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['testees_data_id', 'sub_test_class_id', 'total_answered', 'total_correct', 'total_wrong', 'total_score', 'total_time'], 'required'],
            [['testees_data_id', 'sub_test_class_id', 'total_answered', 'total_correct', 'total_wrong', 'total_score', 'total_time', 'created_at', 'updated_at'], 'integer'],
            [['sub_test_class_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubTestClass::className(), 'targetAttribute' => ['sub_test_class_id' => 'id']],
            [['testees_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => TesteesData::className(), 'targetAttribute' => ['testees_data_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'testees_data_id' => 'Testees Data ID',
            'sub_test_class_id' => 'Sub Test Class ID',
            'total_answered' => 'Soal Dijawab',
            'total_correct' => 'Jawaban Benar',
            'total_wrong' => 'Jawaban Salah',
            'total_score' => 'Skor',
            'total_time' => 'Waktu Pengerjaan',
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
     * Gets query for [[TesteesData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesteesData()
    {
        return $this->hasOne(TesteesData::className(), ['id' => 'testees_data_id']);
    }
}
