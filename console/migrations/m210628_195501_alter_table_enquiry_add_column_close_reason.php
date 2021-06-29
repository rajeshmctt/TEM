<?php

use yii\db\Migration;

/**
 * Class m210628_195501_alter_table_enquiry_add_column_close_reason
 */
class m210628_195501_alter_table_enquiry_add_column_close_reason extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('enquiry', 'close_reason', 'VARCHAR(255) AFTER source');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210628_195501_alter_table_enquiry_add_column_close_reason cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210628_195501_alter_table_enquiry_add_column_close_reason cannot be reverted.\n";

        return false;
    }
    */
}
