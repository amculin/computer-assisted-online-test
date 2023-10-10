<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_session}}`.
 */
class m230914_123157_create_test_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_session}}', [
            'id' => $this->smallInteger()->unsigned() . ' AUTO_INCREMENT',
            'session_name' => $this->string(48)->notNull(),
            'start_time' => $this->integer()->notNull()->unsigned(),
            'end_time' => $this->integer()->notNull()->unsigned(),
            'created_at' => $this->integer()->notNull()->unsigned(),
            'updated_at' => $this->integer()->notNull()->unsigned(),
            'PRIMARY KEY(id)'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test_session}}');
    }
}
