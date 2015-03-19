<?php

use yii\db\Schema;
use yii\db\Migration;

class m150318_232256_create_bookings_table extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
				CREATE TABLE `bookings` (
				`booking_id` int(10) unsigned NOT NULL,
				`table_id` int(10) unsigned NOT NULL,
				`people` int(11) NOT NULL,
				`user_id` int(11) NOT NULL,
				`date` date NOT NULL,
				`time` time NOT NULL,
				`comment` varchar(3000) DEFAULT NULL,
				`booking_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`booking_id`),
				KEY `bookings_tables_FK` (`table_id`),
				KEY `bookings_user_FK` (`user_id`),
				CONSTRAINT `bookings_tables_FK` FOREIGN KEY (`table_id`) REFERENCES `tables` (`table_id`) ON DELETE CASCADE ON UPDATE CASCADE,
				CONSTRAINT `bookings_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    			')->execute();
    }

    public function down()
    {
		$this->dropTable('bookings');
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
