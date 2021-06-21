<?php

use yii\db\Migration;

/**
 * Class m210602_143012_modify_and_add_columns
 */
class m210602_143012_modify_and_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('enquiry', 'remarks', 'TEXT AFTER currency_id');

        $this->renameColumn('enquiry_batch', 'invoice_raised', 'invoicing');
        $this->addColumn('enquiry_batch', 'installment_plan', 'TEXT AFTER final_status');
        $this->addColumn('enquiry_batch', 'amount', 'INT(11) AFTER final_status');
        $this->addColumn('enquiry_batch', 'currency', 'VARCHAR(20) AFTER final_status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210602_143012_modify_and_add_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210602_143012_modify_and_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
