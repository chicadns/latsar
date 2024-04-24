<?php

use Illuminate\Database\Seeder;

class YosralPasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'dayanti.kharisma@gmail.com',
                'token' => '$2y$10$SGQR5nzzpe871Fy2cDi.h.Lp1fp.2k4luxnUHBykEcAlZ9EVfJiu.',
                'created_at' => '2021-08-24 05:37:16',
                'id' => 2,
            ),
        ));
        
        
    }
}