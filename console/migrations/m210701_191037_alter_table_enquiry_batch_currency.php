<?php

use yii\db\Migration;

/**
 * Class m210701_191037_alter_table_enquiry_batch_currency
 */
class m210701_191037_alter_table_enquiry_batch_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('enquiry_batch', 'currency', 'INT(11)');

        
		$this->addForeignKey('fk_enquiry_batch_currency', 'enquiry_batch', 'currency', 'currency', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210701_191037_alter_table_enquiry_batch_currency cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210701_191037_alter_table_enquiry_batch_currency cannot be reverted.\n";

        return false;
    }
    */
}
