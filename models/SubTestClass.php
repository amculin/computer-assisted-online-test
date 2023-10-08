<?php
namespace app\models;

class SubTestClass extends BaseSubTestClass
{
    public function getConvertedTime()
    {
        $hour = floor($this->limit_time / 3600);
        $minute = floor(($this->limit_time % 3600) / 60);
        $second = ($this->limit_time %3600) % 60;

        return str_pad($hour, 2, 0, STR_PAD_LEFT) . ':'
            . str_pad($minute, 2, 0, STR_PAD_LEFT) . ':' . str_pad($second, 2, 0, STR_PAD_LEFT);
    }

    public static function getList()
    {
        $table = self::tableName();
        $query = "SELECT id, name FROM {$table}";

        return self::getDb()->createCommand($query)->queryAll();
    }
}
