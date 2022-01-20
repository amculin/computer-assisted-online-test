<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testees_class".
 *
 * @property int $id
 * @property int $testees_data_id
 * @property int $class_id
 * @property int $created_at
 * @property int|null $updated_at
 */
class BaseTesteesClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testees_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['testees_data_id', 'class_id', 'created_at'], 'required'],
            [['testees_data_id', 'class_id', 'created_at', 'updated_at'], 'integer'],
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
            'class_id' => 'Class ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
