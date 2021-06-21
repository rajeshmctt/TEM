<?php

use yii\db\Migration;

/**
 * Class m210601_112838_create_table_user_batch
 */
class m210601_112838_create_table_user_batch extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_batch', [
            'id' => $this->primaryKey(),
			'name' => 'VARCHAR(50)',
            'user_id' => 'INT',
            'program_id' => 'INT',
            'batch_id' => 'INT',
            'start_date' => 'INT ',
            'created_at' => 'INT ',
            'updated_at' => 'INT ',
            'final_status' => 'VARCHAR(50)',
            'invoice_raised' => 'TINYINT',
            'status' => 'INT',

        ]); 
        
		$this->addForeignKey('fk_ub_user', 'user_batch', 'user_id', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_ub_batch', 'user_batch', 'batch_id', 'batch', 'id', 'SET NULL', 'SET NULL');

        $this->dropColumn('enquiry', 'final_status_l1');
        $this->dropColumn('enquiry', 'invoice_raised_l1');

        $this->dropForeignKey('fk_enq_batch_l1', 'enquiry');
		$this->dropForeignKey('fk_enq_batch_l2', 'enquiry');
		$this->dropForeignKey('fk_enq_batch_l3', 'enquiry');

        $this->dropColumn('enquiry', 'l1_batch');
        $this->dropColumn('enquiry', 'l1_status');
        $this->dropColumn('enquiry', 'final_status_l2');
        $this->dropColumn('enquiry', 'invoice_raised_l2');
        $this->dropColumn('enquiry', 'l2_batch');
        $this->dropColumn('enquiry', 'l2_status');
        $this->dropColumn('enquiry', 'final_status_l3');
        $this->dropColumn('enquiry', 'invoice_raised_l3');
        $this->dropColumn('enquiry', 'l3_batch');
        $this->dropColumn('enquiry', 'l3_status');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210601_112838_create_table_user_batch cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210601_112838_create_table_user_batch cannot be reverted.\n";

        return false;
    }
    */
}
