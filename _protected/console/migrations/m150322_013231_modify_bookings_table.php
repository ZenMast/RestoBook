<?php

use yii\db\Schema;
use yii\db\Migration;

class m150322_013231_modify_bookings_table extends Migration
{
    public function up()
    {	
    	$this->db->createCommand('
			ALTER TABLE bronrestdata.bookings MODIFY COLUMN booking_id int NOT NULL AUTO_INCREMENT;    			
    		')->execute();
    }

    public function down()
    {
    	$this->db->createCommand('
			ALTER TABLE bronrestdata.bookings MODIFY COLUMN booking_id int NOT NULL;
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
