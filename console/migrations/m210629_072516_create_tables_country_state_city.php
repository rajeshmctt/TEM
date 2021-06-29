<?php

use yii\db\Migration;

/**
 * Class m210629_072516_create_tables_country_state_city
 */
class m210629_072516_create_tables_country_state_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'country' => 'VARCHAR(50) ',
            'name' => 'VARCHAR(255)',
        ]); 
        $this->createTable('state', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255)',
            'country_id' => 'INT ',
        ]); 
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255)',
            'country_id' => 'INT ',
            'state_id' => 'INT ',
        ]); 
        
        $this->addColumn('enquiry', 'countries_id', 'INT(11) AFTER country_id');
        $this->addColumn('enquiry', 'state_id', 'INT(11) AFTER countries_id');
        $this->addColumn('enquiry', 'city_id', 'INT(11) AFTER state_id');

		$this->addForeignKey('fk_enquiry_countries', 'enquiry', 'countries_id', 'country', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_enquiry_state', 'enquiry', 'state_id', 'state', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_enquiry_city', 'enquiry', 'city_id', 'city', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_state_country', 'state', 'country_id', 'country', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_city_country', 'city', 'country_id', 'country', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_city_state', 'enquiry', 'state_id', 'state', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210629_072516_create_tables_country_state_city cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210629_072516_create_tables_country_state_city cannot be reverted.\n";

        return false;
    }
    */
}
