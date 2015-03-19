<?php

use yii\db\Schema;
use yii\db\Migration;

class m150318_231726_create_restaurants_table extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
				CREATE TABLE `restaurants` (
				`restaurant_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(200) NOT NULL,
				`opening_time` time DEFAULT NULL,
				`closing_time` time DEFAULT NULL,
				`country` varchar(200) NOT NULL,
				`city` varchar(200) NOT NULL,
				`address` varchar(200) NOT NULL,
				`cuisine` int(10) unsigned DEFAULT NULL,
				`vegetarian` tinyint(1) DEFAULT NULL,
				`wifi` tinyint(1) DEFAULT NULL,
				`max_people` int(11) DEFAULT NULL,
				`website` varchar(300) DEFAULT NULL,
				`email` varchar(200) NOT NULL,
				`phone` varchar(300) NOT NULL,
				`description` varchar(20000) DEFAULT NULL,
				PRIMARY KEY (`restaurant_id`),
				KEY `restaurants_cuisines_FK` (`cuisine`),
				CONSTRAINT `restaurants_cuisines_FK` FOREIGN KEY (`cuisine`) REFERENCES `cuisines` (`cuisine_id`) ON DELETE CASCADE ON UPDATE CASCADE
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    			')->execute();
    }

    public function down()
    {
		$this->dropTable('restaurants');
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
