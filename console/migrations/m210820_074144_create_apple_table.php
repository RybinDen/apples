<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m210820_074144_create_apple_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->notNull(),
            'date_create' => $this->timestamp()->notNull(), //datetime
            'date_down' => $this->timestamp(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1), // 1 на дереве, 0 упало
            'condition' => $this->smallInteger()->notNull()->defaultValue(1), // состояние 1 на дереве (можно сделать только статус)
            'size' => $this->decimal(1,2)->notNull()->defaultValue(0.00), // сколько процентов съедено
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
