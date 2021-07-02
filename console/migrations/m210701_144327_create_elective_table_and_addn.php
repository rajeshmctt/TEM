<?php

use yii\db\Migration;

/**
 * Class m210701_144327_create_elective_table_and_addn
 */
class m210701_144327_create_elective_table_and_addn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {        
        $this->createTable('elective', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255)',
            'hours' => 'INT(11)',
            'tentative_date' => 'INT(11)',
            'created_at' => 'INT ',
            'updated_at' => 'INT ',
        ]); 
        $this->createTable('enquiry_batch_electives', [
            'id' => $this->primaryKey(),
            'enquiry_batch_id' => 'INT',
            'elective_id' => 'INT',
            'created_at' => 'INT ',
            'updated_at' => 'INT ',
        ]); 
        
        $this->addColumn('currency', 'country_id', 'INT(11) AFTER name');
        
		$this->addForeignKey('fk_ebe_enquiry_batch', 'enquiry_batch_electives', 'enquiry_batch_id', 'enquiry_batch', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_ebe_elective', 'enquiry_batch_electives', 'elective_id', 'elective', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_currency_country', 'currency', 'country_id', 'country', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210701_144327_create_elective_table_and_addn cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210701_144327_create_elective_table_and_addn cannot be reverted.\n";

        return false;
    }
    */
}
