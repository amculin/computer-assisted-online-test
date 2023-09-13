<?php
namespace app\models;

class TestClass extends BaseTestClass
{
    public function beforeValidate()
    {
        parent::beforeValidate();

        $this->logo = $this->getLogo();

        return true;
    }

    public function getLogo()
    {
        if ($this->type == self::ACCURACY_TEST)
            return 'accuracy-test.png';
        else if ($this->type == self::SMART_TEST)
            return 'personality-test.png';
        else
            return 'smart-test.png';
    }
}