<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_session".
 *
 * @property int $id
 * @property string $session_name
 * @property int $start_time
 * @property int $end_time
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property TestSessionAssignment[] $testSessionAssignments
 */
class BaseTestSession extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_name', 'start_time', 'end_time'], 'required'],
            [['start_time', 'end_time', 'created_at', 'updated_at'], 'integer'],
            [['session_name'], 'string', 'max' => 48]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_name' => 'Nama Sesi',
            'start_time' => 'Waktu Mulai',
            'end_time' => 'Waktu Selesai',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[TestSessionAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestSessionAssignments()
    {
        return $this->hasMany(BaseTestSessionAssignments::className(), ['session_id' => 'id']);
    }
}
