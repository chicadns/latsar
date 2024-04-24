<?php

use Illuminate\Database\Seeder;

class YosralOauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_clients')->delete();
        
        \DB::table('oauth_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => NULL,
                'name' => 'Snipe-IT Personal Access Client',
                'secret' => 'Es4YawSIJZo5i9gs4OHPoqgevkFrvnH6CIu7nWSt',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2021-07-13 03:37:51',
                'updated_at' => '2021-07-13 03:37:51',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => NULL,
                'name' => 'Snipe-IT Password Grant Client',
                'secret' => 'YamQJZAMWWGafduVPlPZ2bVEiAFdZn42sXItfvsN',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2021-07-13 03:37:51',
                'updated_at' => '2021-07-13 03:37:51',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => NULL,
                'name' => 'Snipe-IT Personal Access Client',
                'secret' => 'ky0ho3cMukiMz2RTdLhBpas1tOTNeJLoD3lP3hiL',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2021-07-13 03:38:06',
                'updated_at' => '2021-07-13 03:38:06',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => NULL,
                'name' => 'Snipe-IT Password Grant Client',
                'secret' => 'aOgrwwFDGli1JipFRLOruVxOOtcN7rzI1dQhcvmo',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2021-07-13 03:38:06',
                'updated_at' => '2021-07-13 03:38:06',
            ),
        ));
        
        
    }
}