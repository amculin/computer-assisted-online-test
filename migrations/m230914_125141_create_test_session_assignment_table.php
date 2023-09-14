<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_session_assignment}}`.
 */
class m230914_125141_create_test_session_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_session_assignment}}', [
            'id' => $this->smallInteger()->unsigned() . ' AUTO_INCREMENT',
            'session_id' => $this->smallInteger()->unsigned()->notNull(),
            'sub_test_class_id' => $this->smallInteger()->notNull()->unsigned(),
            'created_at' => $this->integer()->notNull()->unsigned(),
            'updated_at' => $this->integer()->notNull()->unsigned(),
            'PRIMARY KEY(id)'
        ]);

        // add foreign key
        $this->addForeignKey(
            'FK-TestSessionAssignemt-session_id-TO-TestSession-id',
            'test_session_assignment',
            'session_id',
            'test_session',
            'id',
            'NO ACTION'
        );

        // add foreign key
        $this->addForeignKey(
            'FK-TestSessionAssignment-sub_test_class_id-TO-SubTestClass-id',
            'test_session_assignment',
            'sub_test_class_id',
            'sub_test_class',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_session_assignment}}');

        // drops foreign key
        $this->dropForeignKey(
            'FK-TestSessionAssignemt-session_id-TO-TestSession-id',
            'test_session_assignment'
        );

        //drops foreign key
        $this->dropForeignKey(
            'FK-TestSessionAssignment-sub_test_class_id-TO-SubTestClass-id',
            'test_session_assignment'
        );
    }
}
