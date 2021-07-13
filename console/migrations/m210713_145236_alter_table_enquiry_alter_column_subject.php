<?php

use yii\db\Migration;

/**
 * Class m210713_145236_alter_table_enquiry_alter_column_subject
 */
class m210713_145236_alter_table_enquiry_alter_column_subject extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('enquiry', 'subject', 'TEXT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210713_145236_alter_table_enquiry_alter_column_subject cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210713_145236_alter_table_enquiry_alter_column_subject cannot be reverted.\n";

        return false;
    }
    */
}
