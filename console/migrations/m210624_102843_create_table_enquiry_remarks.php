<?php

use yii\db\Migration;

/**
 * Class m210624_102843_create_table_enquiry_remarks
 */
class m210624_102843_create_table_enquiry_remarks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('enquiry_remarks', [
            'id' => $this->primaryKey(),
            'enquiry_id' => 'INT ',
            'date' => 'INT ',
			'remarks' => 'TEXT',          
            'status' => 'INT',
            'created_at' => 'INT ',
            'updated_at' => 'INT ',
            'created_by' => 'INT ',
            'updated_by' => 'INT ',

        ]); 
        
        // $this->addColumn('enquiry', 'remarks_id', 'INT(11) AFTER remarks');

		$this->addForeignKey('fk_enquiry_remarks', 'enquiry_remarks', 'enquiry_id', 'enquiry', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210624_102843_create_table_enquiry_remarks cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210624_102843_create_table_enquiry_remarks cannot be reverted.\n";

        return false;
    }
    */
}
