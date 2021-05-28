<?php

use yii\db\Migration;

/**
 * Class m210519_160855_add_foreign_keys
 */
class m210519_160855_add_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
		
		$this->addForeignKey('fk_enq_country', 'enquiry', 'country_id', 'location', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_enq_program', 'enquiry', 'program_id', 'program', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_enq_batch_l1', 'enquiry', 'l1_batch', 'batch', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_enq_batch_l2', 'enquiry', 'l2_batch', 'batch', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_enq_batch_l3', 'enquiry', 'l3_batch', 'batch', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_enq_currency', 'enquiry', 'currency_id', 'currency', 'id', 'SET NULL', 'SET NULL');

		$this->addForeignKey('fk_batch_program', 'batch', 'program_id', 'program', 'id', 'SET NULL', 'SET NULL');
		// $this->addForeignKey('fk_user_media', 'user', 'media_id', 'media', 'id', 'SET NULL', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210519_160855_add_foreign_keys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210519_160855_add_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
