<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m160901_101518_comments
 */
class m160901_101518_comments extends Migration
{
    public function up()
    {
        $this->createTable('comments', [
            'id'            => \yii\db\Schema::TYPE_PK,
            'tid'           => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Топик"',
            'pid'           => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Родитель"',
            'name'          => Schema::TYPE_STRING . ' NOT NULL COMMENT "Имя"',
            'email'         => Schema::TYPE_STRING . ' NOT NULL COMMENT "E-mail"',
            'text'          => Schema::TYPE_TEXT   . ' NOT NULL COMMENT "Текст"',
            'is_published'  => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1 COMMENT "Опубликовано"',
            'create_date'   => Schema::TYPE_DATETIME   . ' NOT NULL COMMENT "Время создания"',
            'update_date'   => Schema::TYPE_TIMESTAMP   . ' NOT NULL COMMENT "Время обновления"'
        ]);

        $this->createIndex('tid_key', 'comments', 'tid');
        $this->createIndex('pid_key', 'comments', 'pid');
    }

    public function down()
    {
        $this->dropTable('comments');
    }
}
