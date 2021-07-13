<?php

use yii\db\Migration;

/**
 * Class m210713_095136_alter_table_enquiry_add_column_info_email_sent
 */
class m210713_095136_alter_table_enquiry_add_column_info_email_sent extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('enquiry', 'info_email_sent_on', 'INT(11) AFTER owner_id');
    }   

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('enquiry', 'info_email_sent_on');

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210713_095136_alter_table_enquiry_add_column_info_email_sent cannot be reverted.\n";

        return false;
    }
    */
}
