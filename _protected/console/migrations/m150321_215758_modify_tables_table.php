<?php

use yii\db\Schema;
use yii\db\Migration;

class m150321_215758_modify_tables_table extends Migration
{
    public function up()
    {	
    	$this->db->createCommand('
    			ALTER TABLE bronrestdata.bookings DROP FOREIGN KEY bookings_tables_FK;
    			ALTER TABLE bronrestdata.`tables` MODIFY COLUMN table_id int NOT NULL AUTO_INCREMENT;
    			ALTER TABLE bronrestdata.bookings MODIFY COLUMN table_id INT NOT NULL;
    			ALTER TABLE bronrestdata.`tables` MODIFY COLUMN table_id INT NOT NULL AUTO_INCREMENT;
				ALTER TABLE bronrestdata.bookings ADD CONSTRAINT bookings_tables_FK FOREIGN KEY (table_id) REFERENCES bronrestdata.`tables`(table_id) ON DELETE CASCADE ON UPDATE CASCADE;
    			')->execute();
    }

    public function down()
    {
    	//We shouldn't change it back
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
