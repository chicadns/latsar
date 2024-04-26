<?php

use Illuminate\Database\Seeder;

class YosralCustomFieldsetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('custom_fieldsets')->delete();
        
        \DB::table('custom_fieldsets')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Laptop',
                'created_at' => '2021-09-16 15:46:16',
                'updated_at' => '2021-09-16 15:46:16',
                'user_id' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Tablet-PC',
                'created_at' => '2021-09-18 13:49:14',
                'updated_at' => '2021-09-18 13:49:14',
                'user_id' => 1,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Personal Computer',
                'created_at' => '2021-09-18 13:49:14',
                'updated_at' => '2021-09-18 13:49:14',
                'user_id' => 1,
            ),
        ));
        
        
    }
}