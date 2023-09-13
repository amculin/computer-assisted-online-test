<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $logo
 * @property int $status
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property TestClass[] $testClasses
 */
class BaseClass extends BaseModel
{
    public $logo_file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'logo'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'logo'], 'string', 'max' => 48],
            [['description'], 'string', 'max' => 96],
            [['logo_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'description' => 'Deskripsi',
            'logo' => 'Logo',
            'logo_file' => 'Logo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[TestClasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestClasses()
    {
        return $this->hasMany(BaseTestClass::className(), ['class_id' => 'id']);
    }

    /**
     * Gets query for [[TesteesDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesteesDatas()
    {
        return $this->hasMany(BaseTesteesData::className(), ['class_id' => 'id']);
    }
}
