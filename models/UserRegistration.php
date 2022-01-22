<?php

namespace app\models;

use Yii;

class UserRegistration extends BaseUser
{
    const CREATE_USER       = 'create-user';
    const UPDATE_USER       = 'update-user';
    const CHANGE_PASSWORD   = 'change-password';

    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'password_hash', 'email'], 'required', 'on' => self::CREATE_USER],
            [['username', 'email'], 'required', 'on' => self::UPDATE_USER],
            [['password', 'password_hash'], 'required', 'on' => self::CHANGE_PASSWORD],
            ['email', 'email'],
            [['type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['password'], 'string'],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->scenario == self::CREATE_USER) {
            $this->username         = $this->email;
            $this->password_hash    = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $this->auth_key         = md5($this->email . $this->password);
        } else if ($this->scenario == self::UPDATE_USER) {
            $this->username         = $this->email;
        } else if ($this->scenario == self::CHANGE_PASSWORD) {
            $this->password_hash    = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $connection = Yii::$app->db;
            $connection->createCommand()->insert('auth_assignment', [
                'item_name' => 'Student',
                'user_id' => $this->id,
                'created_at' => time()
            ])->execute();
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $connection = Yii::$app->db;
        $connection->createCommand()->delete('auth_assignment', [
            'item_name' => 'Student',
            'user_id' => $this->id
        ])->execute();
    }
}