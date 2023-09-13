<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $type 1 = Administrator; 2 = Tester; 3 = Testees
 * @property int $status 0 = Inactive; 1 = Active;
 * @property string|null $verification_token
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TesteesData[] $testeesDatas 
 */
class BaseUser extends BaseModel
{
    /**
     * Constants value for type column
     */
    const ADMINISTRATOR = 1;
    const TESTER        = 2;
    const TESTEES       = 3;

    /**
     * Constant value for status column
     */
    const ACTIVE    = 1;
    const INACTIVE  = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /** 
    * Gets query for [[TesteesData]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getTesteesData() 
    { 
        return $this->hasOne(TesteesData::className(), ['user_id' => 'id']); 
    }

    public function getStatusName()
    {
        return $this->status == self::ACTIVE ? 'Aktif' : 'Non Aktif';
    }
}
