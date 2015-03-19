<?php

use yii\db\Schema;
use yii\db\Migration;

class m150318_213231_create_cuisines_table extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
    			CREATE TABLE `cuisines` (
				`cuisine_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`cuisine` varchar(300) NOT NULL,
				PRIMARY KEY (`cuisine_id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=\'lookup_table_for_restaurants\';
    			')->execute();
    }

    public function down()
    {
		$this->dropTable('cuisines');
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
