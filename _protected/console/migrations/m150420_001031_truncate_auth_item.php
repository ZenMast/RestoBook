<?php

use yii\db\Schema;
use yii\db\Migration;

class m150420_001031_truncate_auth_item extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
    			DELETE FROM auth_item;
    			')->execute();
    }

    public function down()
    {
        echo "m150420_001031_truncate_auth_item cannot be reverted.\n";

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
