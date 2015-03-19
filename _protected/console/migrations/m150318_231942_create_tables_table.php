<?php

use yii\db\Schema;
use yii\db\Migration;

class m150318_231942_create_tables_table extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
				CREATE TABLE `tables` (
				`max_people` int(10) unsigned DEFAULT NULL,
				`table_id` int(10) unsigned NOT NULL DEFAULT \'0\',
				`restaurant_id` int(10) unsigned NOT NULL,
				PRIMARY KEY (`table_id`),
				KEY `tables_restaurants_FK` (`restaurant_id`),
				CONSTRAINT `tables_restaurants_FK` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE
				) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=\'restaurant tables\';
    			')->execute();
    }

    public function down()
    {
		$this->dropTable('tables');
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
