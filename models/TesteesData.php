<?php

namespace app\models;

use Yii;

class TesteesData extends BaseTesteesData
{
    public function getGenderName()
    {
        if ($this->sex == self::MALE)
            return 'Laki-laki';
        else
            return 'Perempuan';
    }
}
?>