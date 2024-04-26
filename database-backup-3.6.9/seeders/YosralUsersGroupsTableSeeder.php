<?php

use Illuminate\Database\Seeder;

class YosralUsersGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users_groups')->delete();
        
        \DB::table('users_groups')->insert(array (
            0 => 
            array (
                'user_id' => 2,
                'group_id' => 3,
            ),
            1 => 
            array (
                'user_id' => 3,
                'group_id' => 4,
            ),
            2 => 
            array (
                'user_id' => 4,
                'group_id' => 2,
            ),
        ));
        
        
    }
}