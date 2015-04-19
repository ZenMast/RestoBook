<?php

use yii\db\Schema;
use yii\db\Migration;

class m150419_223510_delete_articles_table extends Migration
{
    public function up()
    {
    	$this->db->createCommand('
    			DROP TABLE article;
    			')->execute();
    }

    public function down()
    {
        echo "m150419_223510_delete_articles_table cannot be reverted.\n";

        return false;
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
