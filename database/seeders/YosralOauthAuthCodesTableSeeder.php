<?php

use Illuminate\Database\Seeder;

class YosralOauthAuthCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_auth_codes')->delete();
        
        
        
    }
}