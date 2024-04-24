<?php

use Illuminate\Database\Seeder;

class YosralDepreciationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('depreciations')->delete();
        
        
        
    }
}