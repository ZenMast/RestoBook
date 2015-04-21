<?php

use yii\db\Schema;
use yii\db\Migration;

class m150420_002523_truncate_users extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
    			DELETE FROM user;
    			')->execute();
    }

    public function down()
    {
        echo "m150420_002523_truncate_users cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
