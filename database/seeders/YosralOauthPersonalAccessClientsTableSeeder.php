<?php

use Illuminate\Database\Seeder;

class YosralOauthPersonalAccessClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_personal_access_clients')->delete();
        
        \DB::table('oauth_personal_access_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'client_id' => 1,
                'created_at' => '2021-07-13 03:37:51',
                'updated_at' => '2021-07-13 03:37:51',
            ),
            1 => 
            array (
                'id' => 2,
                'client_id' => 3,
                'created_at' => '2021-07-13 03:38:06',
                'updated_at' => '2021-07-13 03:38:06',
            ),
        ));
        
        
    }
}