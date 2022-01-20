<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_class".
 *
 * @property int $id
 * @property int $class_id
 * @property string $name
 * @property string|null $description
 * @property string $logo
 * @property int $type
 * @property int|null $status
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property SubTestClass[] $subTestClasses
 * @property Class $class
 */
class BaseTestClass extends BaseModel
{
    const ACCURACY_TEST = 1;
    const PERSONALITY_TEST = 2;
    const SMART_TEST = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'name', 'logo'], 'required'],
            [['class_id', 'type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'logo'], 'string', 'max' => 24],
            [['description'], 'string', 'max' => 96],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseClass::className(), 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Kelas',
            'name' => 'Nama',
            'description' => 'Description',
            'logo' => 'Logo',
            'type' => 'Tipe',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[SubTestClasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubTestClasses()
    {
        return $this->hasMany(BaseSubTestClass::className(), ['test_class_id' => 'id']);
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(BaseClass::className(), ['id' => 'class_id']);
    }
}
