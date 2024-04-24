<?php

use Illuminate\Database\Seeder;

class YosralCheckoutRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('checkout_requests')->delete();
        
        
        
    }
}