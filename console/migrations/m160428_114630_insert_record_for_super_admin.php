<?php

use yii\db\Migration;

class m160428_114630_insert_record_for_super_admin extends Migration
{
     public function up()
    {
		$time = time();
		$this->insert('user',array(
         'username'=>'admin',
         'full_name'=>'admin',
         'auth_key'=>'Chkmx-mYmIp6WYvTjIxEcXSPxawEMbH8',
         'password_hash'=>'$2y$13$eA0JQAI5cQz5L1J1dGh8Xes.R10A6dcfrpC/9VuuH03NbumLf7xgK', // admin123@
		 'email'=>'info@coachtotransformation.com',
         // 'role' => '1',
         'created_at' => $time,
         'updated_at' => $time
		));

    }

    public function down()
    {
        
    }
}
