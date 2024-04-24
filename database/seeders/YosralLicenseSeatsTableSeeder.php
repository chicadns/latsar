<?php

use Illuminate\Database\Seeder;

class YosralLicenseSeatsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('license_seats')->delete();
        
        \DB::table('license_seats')->insert(array (
            0 => 
            array (
                'id' => 1,
                'license_id' => 1,
                'assigned_to' => NULL,
                'notes' => NULL,
                'user_id' => 1,
                'created_at' => '2021-09-01 20:54:27',
                'updated_at' => '2021-09-22 19:33:15',
                'deleted_at' => NULL,
                'asset_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'license_id' => 1,
                'assigned_to' => NULL,
                'notes' => NULL,
                'user_id' => NULL,
                'created_at' => '2021-09-01 20:54:27',
                'updated_at' => '2021-09-15 15:05:24',
                'deleted_at' => '2021-09-15 15:05:24',
                'asset_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'license_id' => 1,
                'assigned_to' => 2,
                'notes' => NULL,
                'user_id' => 1,
                'created_at' => '2021-09-16 15:17:02',
                'updated_at' => '2021-09-18 14:45:09',
                'deleted_at' => NULL,
                'asset_id' => NULL,
            ),
        ));
        
        
    }
}