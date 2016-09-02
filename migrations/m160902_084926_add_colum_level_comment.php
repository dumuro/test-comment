<?php

use yii\db\Migration;

/**
 * Class m160902_084926_add_colum_level_comment
 */
class m160902_084926_add_colum_level_comment extends Migration
{
    public function up()
    {
        $this->addColumn('comments','level', 'INT(11) AFTER pid');
    }

    public function down(){}
}
