<?php

use yii\db\Migration;

/**
 * Class m210716_072339_alter_table_enquiry_alter_column_closed_reason
 */
class m210716_072339_alter_table_enquiry_alter_column_closed_reason extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('enquiry', 'close_reason', 'INT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210716_072339_alter_table_enquiry_alter_column_closed_reason cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210716_072339_alter_table_enquiry_alter_column_closed_reason cannot be reverted.\n";

        return false;
    }
    */
}
