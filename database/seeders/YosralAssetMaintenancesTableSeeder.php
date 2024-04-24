<?php

use Illuminate\Database\Seeder;

class YosralAssetMaintenancesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('asset_maintenances')->delete();
        
        \DB::table('asset_maintenances')->insert(array (
            0 => 
            array (
                'id' => 1,
                'asset_id' => 3,
                'supplier_id' => 1,
                'asset_maintenance_type' => 'Perbaikan',
                'lokasi_barang' => 'Pemeliharaan di vendor',
                'title' => 'keyboard rusak',
                'is_warranty' => 0,
                'start_date' => '2021-09-21',
                'completion_date' => NULL,
                'asset_maintenance_time' => NULL,
                'notes' => NULL,
                'cost' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2021-09-21 09:53:45',
                'updated_at' => '2021-09-23 23:16:11',
                'user_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'asset_id' => 1,
                'supplier_id' => 1,
                'asset_maintenance_type' => 'Klaim Garansi',
                'lokasi_barang' => 'Masuk ke teknisi',
                'title' => 'Baterai',
                'is_warranty' => 0,
                'start_date' => '2021-09-24',
                'completion_date' => NULL,
                'asset_maintenance_time' => NULL,
                'notes' => NULL,
                'cost' => NULL,
                'deleted_at' => '2021-09-24 13:57:56',
                'created_at' => '2021-09-24 13:57:21',
                'updated_at' => '2021-09-24 13:57:56',
                'user_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'asset_id' => 1,
                'supplier_id' => 1,
                'asset_maintenance_type' => 'Perbaikan',
                'lokasi_barang' => 'Masuk ke teknisi',
                'title' => 'Layar',
                'is_warranty' => 0,
                'start_date' => '2021-09-24',
                'completion_date' => NULL,
                'asset_maintenance_time' => NULL,
                'notes' => NULL,
                'cost' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2021-09-24 14:19:14',
                'updated_at' => '2021-09-24 14:19:14',
                'user_id' => 1,
            ),
        ));
        
        
    }
}