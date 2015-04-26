<?php

use yii\db\Schema;
use yii\db\Migration;

class m150421_183710_add_restaurantid_field_to_user_table extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
    			ALTER TABLE user ADD restaurant_id INT DEFAULT NULL; 
    			')->execute();    	 
    }

    public function down()
    {
        echo "m150421_183710_add_restaurantid_field_to_user_table cannot be reverted.\n";

//         return false;
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
