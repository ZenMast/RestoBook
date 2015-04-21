<?php

use yii\db\Schema;
use yii\db\Migration;

class m150421_222735_delete_username_from_user extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
    			ALTER TABLE user DROP COLUMN username;
    			')->execute();
    }
    

    public function down()
    {
        echo "m150421_222735_delete_username_from_user cannot be reverted.\n";

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
