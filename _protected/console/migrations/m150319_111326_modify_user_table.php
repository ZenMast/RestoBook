<?php

use yii\db\Schema;
use yii\db\Migration;

class m150319_111326_modify_user_table extends Migration
{
    public function up()
    {	
    	$this->db->createCommand('
				ALTER TABLE user ADD COLUMN name varchar(200) DEFAULT NULL;
    			')->execute();
    }

    public function down()
    {
    	$this->db->createCommand('
				ALTER TABLE user DROP COLUMN name;
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
