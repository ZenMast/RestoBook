<?php

use yii\db\Schema;
use yii\db\Migration;

class m150420_000950_truncate_auth_assignment extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
    			DELETE FROM auth_assignment;
    			')->execute();
    }

    public function down()
    {
        echo "m150420_000950_truncate_auth_assignment cannot be reverted.\n";

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
