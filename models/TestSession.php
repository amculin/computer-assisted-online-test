<?php

namespace app\models;

use app\models\BaseTestSessionAssignment as SessionAssignment;

class TestSession extends BaseTestSession
{
    public $sub_test_class;
    public $start_time_picker;
    public $end_time_picker;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'session_name', 'sub_test_class', 'start_time_picker', 'end_time_picker',
                    'start_time', 'end_time'
                ], 'required'
            ],
            [['start_time_picker', 'end_time_picker', 'sub_test_class', 'start_time', 'end_time'], 'safe'],
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
            'sub_test_class' => 'Nama Tes',
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

    public function getAssignedTest()
    {
        $data = [];

        foreach ($this->testSessionAssignments as $key => $val) {
            $data[] = $val->sub_test_class_id;
        }

        return $data;
    }

    public function getConvertedTime($time)
    {
        return date('Y-m-d H:i', $time);
    }

    public function insertNewAssignments()
    {
        foreach ($this->sub_test_class as $key => $val) {
            $model = new SessionAssignment();
            $model->session_id = $this->id;
            $model->sub_test_class_id = $val;
            $model->save();
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->insertNewAssignments();
        } else {
            SessionAssignment::deleteAll(['session_id' => $this->id]);
            $this->insertNewAssignments();
        }
    }
}
