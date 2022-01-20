<?php
namespace app\models;

class SubTestClass extends BaseSubTestClass
{
    public function getConvertedTime()
    {
        $hour = floor($this->limit_time / 3600);//Math.floor(limitTime / 3600).toString();
        $minute = floor(($this->limit_time % 3600) / 60); //Math.floor((limitTime % 3600) / 60).toString();
        $second = ($this->limit_time %3600) % 60;//var second = ((limitTime % 3600) % 60).toString();

        return str_pad($hour, 2, 0, STR_PAD_LEFT) . ':' . str_pad($minute, 2, 0, STR_PAD_LEFT) . ':' . str_pad($second, 2, 0, STR_PAD_LEFT);
    }
}
?>