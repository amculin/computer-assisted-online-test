<?php
namespace app\models;

class TestSessionAssignment extends BaseTestSessionAssignment
{
    public static function getActiveSession($testClassId)
    {
        $sql = "SELECT sa.sub_test_class_id
            FROM test_session_assignment sa
            JOIN test_session s on s.id = sa.session_id
            JOIN sub_test_class tc on sa.sub_test_class_id = tc.id
            WHERE s.start_time <= :timestamp AND s.end_time >= :timestamp AND tc.test_class_id = :test_class_id";
        
        $bound = [
            ':timestamp' => time(),
            ':test_class_id' => $testClassId
        ];

        return array_column(self::getDb()->createCommand($sql, $bound)->queryAll(), 'sub_test_class_id');
    }

    public static function getClassSessionStatus($subTestClassId)
    {
        $sql = "SELECT s.session_name, s.start_time, s.end_time
            FROM `test_session_assignment` ta
            JOIN test_session s ON s.id = ta.session_id
            WHERE ta.sub_test_class_id = :sub_test_class_id
                AND s.start_time <= :timestamp AND s.end_time >= :timestamp";
        
        $bound = [
            ':sub_test_class_id' => $subTestClassId,
            ':timestamp' => time()
        ];

        return self::getDb()->createCommand($sql, $bound)->queryOne();
    }
}
