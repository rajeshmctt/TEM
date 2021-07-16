<?php

use yii\db\Migration;

/**
 * Class m210715_105734_alter_table_enquiry_alter_column_date_of_enquiry
 */
class m210715_105734_alter_table_enquiry_alter_column_date_of_enquiry extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('enquiry', 'date_of_enquiry', 'DATE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('enquiry', 'date_of_enquiry', 'INT');

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210715_105734_alter_table_enquiry_alter_column_date_of_enquiry cannot be reverted.\n";

        return false;
    }
    */
}
