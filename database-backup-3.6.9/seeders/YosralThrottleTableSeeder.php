<?php

use Illuminate\Database\Seeder;

class YosralThrottleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('throttle')->delete();
        
        
        
    }
}