<?php

use yii\db\Migration;

/**
 * Class m210519_132531_create_tables_for_tem
 */
class m210519_132531_create_tables_for_tem extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('enquiry', [
            'id' => $this->primaryKey(),
            'date_of_enquiry' => 'INT NULL',
			'full_name' => 'VARCHAR(255)',
			'contact_no' => 'VARCHAR(20)',
			'email' => 'VARCHAR(50)',
			'address' => 'VARCHAR(255)',
			'owner' => 'VARCHAR(255)',
            'city' => 'VARCHAR(50)',
            'country_id' => 'INT',
            'source' => 'VARCHAR(50)',
            'subject' => 'VARCHAR(255)',
            'referred_by' => 'VARCHAR(50)',
            'program_id' => 'INT',
            'final_status_l1' => 'VARCHAR(50)',
            'invoice_raised_l1' => 'TINYINT',
            'l1_batch' => 'INT',
            'l1_status' => 'INT',
            'final_status_l2' => 'VARCHAR(50)',
            'invoice_raised_l2' => 'TINYINT',
            'l2_batch' => 'INT',
            'l2_status' => 'INT',
            'final_status_l3' => 'VARCHAR(50)',
            'invoice_raised_l3' => 'TINYINT',
            'l3_batch' => 'INT',
            'l3_status' => 'INT',
            'amount' => 'INT NULL',
            'currency_id' => 'INT',
			'status' => 'SMALLINT(6)', 
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL'
        ]);
		$this->createTable('location', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(255)',
			'status' => 'SMALLINT(6)', 
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL' 
        ]);
		$this->createTable('currency', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(50)',
            'created_at' => 'INT ',
            'updated_at' => 'INT ',
        ]); 
		$this->createTable('program', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(255)',
            'created_at' => 'INT NULL',
            'updated_at' => 'INT NULL' 
        ]);
		$this->createTable('batch', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(50)',
            'program_id' => 'INT',
            'start_date' => 'INT ',
            'created_at' => 'INT ',
            'updated_at' => 'INT ',
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m210519_132531_create_tables_for_tem cannot be reverted.\n";
        $this->dropTable('enquiry');
        $this->dropTable('location');
        $this->dropTable('currency');
        $this->dropTable('program');
        $this->dropTable('batch');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210519_132531_create_tables_for_tem cannot be reverted.\n";

        return false;
    }
    */
}
