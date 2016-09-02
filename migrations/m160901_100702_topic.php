<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m160901_100702_topic
 */
class m160901_100702_topic extends Migration
{
    public function up()
    {
        $this->createTable('topic', [
            'id'            => \yii\db\Schema::TYPE_PK,
            'name'          => Schema::TYPE_STRING    . ' NOT NULL',
            'alias'         => Schema::TYPE_STRING    . ' NOT NULL',
            'text'          => Schema::TYPE_TEXT      . ' NOT NULL',
            'is_published'  => Schema::TYPE_SMALLINT  . ' DEFAULT 0',
            'author'        => Schema::TYPE_STRING    . ' NOT NULL',
            'create_date'   => Schema::TYPE_DATETIME  . ' NOT NULL',
            'update_date'   => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ]);

        $this->createIndex('alias_key', 'topic', 'alias');
    }

    public function down()
    {
        $this->dropTable('topic');
    }
}
