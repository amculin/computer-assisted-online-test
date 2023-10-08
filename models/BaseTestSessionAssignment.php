<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_session_assignment".
 *
 * @property int $id
 * @property int $session_id
 * @property int $sub_test_class_id
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property TestSession $testSession
 * @property SubTestClasses[] $subTestClasses
 */
class BaseTestSessionAssignment extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_session_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'sub_test_class_id'], 'required'],
            [['session_id', 'sub_test_class_id', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Nama Sesi',
            'sub_test_class_id' => 'Nama Sub Tes Kelas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(BaseTestSession::className(), ['id' => 'session_id']);
    }

    /**
     * Gets query for [[SubTestClass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubTestClass()
    {
        return $this->hasOne(BaseSubTestClass::className(), ['id' => 'sub_test_class_id']);
    }
}
