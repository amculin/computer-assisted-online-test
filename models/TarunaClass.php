<?php
namespace app\models;

class TarunaClass extends BaseClass
{
    public function upload()
    {
        if ($this->validate()) {
            $this->logo_file->saveAs('images/logo/' . $this->logo_file->baseName . '.' . $this->logo_file->extension);
            return true;
        } else {
            return false;
        }
    }
}