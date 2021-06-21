<?php

use yii\db\Migration;

/**
 * Class m210601_143658_create_table_enquiry_batch
 */
class m210601_143658_create_table_enquiry_batch extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('enquiry_batch', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(50)',
            'enquiry_id' => 'INT',
            'program_id' => 'INT',
            'batch_id' => 'INT',
            'start_date' => 'INT ',
            'created_at' => 'INT ',
            'updated_at' => 'INT ',
            'final_status' => 'VARCHAR(50)',
            'invoice_raised' => 'TINYINT',
            'status' => 'INT',

        ]); 
        
		$this->addForeignKey('fk_eb_enquiry', 'enquiry_batch', 'enquiry_id', 'enquiry', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_eb_batch', 'enquiry_batch', 'batch_id', 'batch', 'id', 'SET NULL', 'SET NULL');
        // echo "m210601_143658_create_table_enquiry_batch yes.\n";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210601_143658_create_table_enquiry_batch cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210601_143658_create_table_enquiry_batch cannot be reverted.\n";

        return false;
    }
    */
}
