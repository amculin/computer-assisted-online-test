<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testees_data".
 *
 * @property int $id
 * @property int $user_id
 * @property string $full_name
 * @property int $sex 1 = Laki-laki; 2 = Perempuan;
 * @property string $birth_date
 * @property string $address
 * @property string $phone_number
 * @property string $school_origin
 * @property int $school_entry_year
 * @property string $purpose
 * @property int $class_id
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property TesteesAnswer[] $testeesAnswers
 * @property User $user 
 */
class BaseTesteesData extends BaseModel
{
    /**
     * Constants value for sex column
     */
    const MALE = 1;
    const FEMALE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testees_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'full_name', 'sex', 'birth_date', 'address', 'phone_number', 'school_origin', 'school_entry_year', 'purpose', 'class_id'
                ], 'required'
            ],
            [['user_id', 'sex', 'school_entry_year', 'class_id', 'created_at', 'updated_at'], 'integer'],
            [['birth_date'], 'safe'], 
            [['full_name'], 'string', 'max' => 96],
            [['address', 'purpose'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15],
            [['school_origin'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'full_name' => 'Nama Lengkap',
            'sex' => 'Gender',
            'birth_date' => 'Tanggal Lahir',
            'address' => 'Alamat',
            'phone_number' => 'Nomor HP (WA)',
            'school_origin' => 'Asal Sekolah',
            'school_entry_year' => 'Angkatan',
            'purpose' => 'Tujuan Mendaftar',
            'class_id' => 'Kelas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[TesteesAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesteesAnswers()
    {
        return $this->hasMany(BaseTesteesAnswer::className(), ['testees_id' => 'id']);
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

    /**
    * Gets query for [[User]].
    *
    * @return \yii\db\ActiveQuery
    */
   public function getUser()
   {
       return $this->hasOne(BaseUser::className(), ['id' => 'user_id']);
   }

    public function beforeValidate()
    {
        parent::beforeValidate();

        $this->birth_date = date('Y-m-d', strtotime($this->birth_date));

        return true;
    }
}
