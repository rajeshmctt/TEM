<?php

use yii\db\Migration;

/**
 * Class m210625_053811_alter_tables_enquiry_and_program
 */
class m210625_053811_alter_tables_enquiry_and_program extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('enquiry', 'enq_status', 'INT(11) AFTER remarks');
        $this->addColumn('program', 'hours', 'INT(11) AFTER name');
        $this->addColumn('program', 'tentative_date', 'INT(11) AFTER name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210625_053811_alter_tables_enquiry_and_program cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210625_053811_alter_tables_enquiry_and_program cannot be reverted.\n";

        return false;
    }
    */
}
