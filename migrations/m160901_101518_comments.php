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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('comments', [
            'id'            => \yii\db\Schema::TYPE_PK,
            'tid'           => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "�����"',
            'pid'           => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "��������"',
            'name'          => Schema::TYPE_STRING . ' NOT NULL COMMENT "���"',
            'email'         => Schema::TYPE_STRING . ' NOT NULL COMMENT "E-mail"',
            'text'          => Schema::TYPE_TEXT   . ' NOT NULL COMMENT "�����"',
            'is_published'  => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1 COMMENT "������������"',
            'create_date'   => Schema::TYPE_DATETIME   . ' NOT NULL COMMENT "����� ��������"',
            'update_date'   => Schema::TYPE_TIMESTAMP   . ' NOT NULL COMMENT "����� ����������"'
        ],$tableOptions);

        $this->createIndex('tid_key', 'comments', 'tid');
        $this->createIndex('pid_key', 'comments', 'pid');
    }

    public function down()
    {
        $this->dropTable('comments');
    }
}
