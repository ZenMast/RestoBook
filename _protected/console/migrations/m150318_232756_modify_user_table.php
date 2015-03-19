<?php

use yii\db\Schema;
use yii\db\Migration;

class m150318_232756_modify_user_table extends Migration
{
    public function up()
    {	
    	$this->db->createCommand('
				ALTER TABLE user ADD COLUMN phone varchar(300) DEFAULT NULL;
				ALTER TABLE user ADD COLUMN facebook_id varchar(300) DEFAULT NULL;
    			')->execute();
    }

    public function down()
    {
    	$this->db->createCommand('
				ALTER TABLE user DROP COLUMN phone;
				ALTER TABLE user DROP COLUMN facebook_id;
    			')->execute();
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
