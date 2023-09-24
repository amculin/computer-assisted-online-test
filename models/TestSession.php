<?php

namespace app\models;

class TestSession extends BaseTestSession
{
    public $start_time_picker;
    public $end_time_picker;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_name', 'start_time_picker', 'end_time_picker', 'start_time', 'end_time'], 'required'],
            [['start_time', 'end_time', 'created_at', 'updated_at'], 'integer'],
            [['session_name'], 'string', 'max' => 48]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_name' => 'Nama Sesi',
            'start_time' => 'Waktu Mulai',
            'start_time_picker' => 'Waktu Mulai',
            'end_time' => 'Waktu Selesai',
            'end_time_picker' => 'Waktu Selesai',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeValidate()
    {
        parent::beforeValidate();

        $this->start_time = strtotime($this->start_time_picker);
        $this->end_time = strtotime($this->end_time_picker);

        return true;
    }

    public function getConvertedTime($time)
    {
        $date = date('d F Y, H:i', $time);

        return $date;
    }
}