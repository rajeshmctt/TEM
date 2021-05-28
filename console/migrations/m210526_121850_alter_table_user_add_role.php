<?php

use yii\db\Migration;

/**
 * Class m210526_121850_alter_table_user_add_role
 */
class m210526_121850_alter_table_user_add_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', 'INT(11) AFTER password_reset_token');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m210526_121850_alter_table_user_add_role cannot be reverted.\n";
        $this->dropColumn('user', 'role');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210526_121850_alter_table_user_add_role cannot be reverted.\n";

        return false;
    }
    */
}
