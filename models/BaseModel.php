<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;

class BaseModel extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}