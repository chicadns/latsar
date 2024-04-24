<?php

use Illuminate\Database\Seeder;

class YosralCheckoutAcceptancesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('checkout_acceptances')->delete();
        
        
        
    }
}