<?php

use yii\db\Migration;

/**
 * Class m210618_151917_create_table_owner
 */
class m210618_151917_create_table_owner extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('owner', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(50)',
            'email' => $this->string()->notNull()->unique(),
            'contact_no' => $this->string(255),            
            'status' => 'INT',

        ]); 
        
        $this->addColumn('enquiry', 'owner_id', 'INT(11) AFTER owner');

		$this->addForeignKey('fk_enquiry_owner', 'enquiry', 'owner_id', 'owner', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210618_151917_create_table_owner cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210618_151917_create_table_owner cannot be reverted.\n";

        return false;
    }
    */
}
