<?php

use Illuminate\Database\Seeder;

class YosralSuppliersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('suppliers')->delete();
        
        \DB::table('suppliers')->insert(array (
            0 =>
            array('id' => '1','name' => 'PT. INOCOM','address' => NULL,'address2' => NULL,'city' => NULL,'state' => NULL,'country' => NULL,'phone' => NULL,'fax' => NULL,'email' => NULL,'contact' => NULL,'notes' => NULL,'created_at' => '2021-11-18 09:14:35','updated_at' => '2021-11-18 09:14:35','user_id' => '1','deleted_at' => NULL,'zip' => NULL,'url' => 'http://','image' => NULL),
            1 =>
            array('id' => '2','name' => 'PT. Niaga Prima Paramitra','address' => NULL,'address2' => NULL,'city' => NULL,'state' => NULL,'country' => NULL,'phone' => NULL,'fax' => NULL,'email' => NULL,'contact' => NULL,'notes' => NULL,'created_at' => '2021-11-18 09:15:37','updated_at' => '2021-11-18 09:15:37','user_id' => '1','deleted_at' => NULL,'zip' => NULL,'url' => 'http://','image' => NULL),
            2 =>
            array('id' => '3','name' => 'PT. Berca Hardayaperkasa','address' => NULL,'address2' => NULL,'city' => NULL,'state' => NULL,'country' => NULL,'phone' => NULL,'fax' => NULL,'email' => NULL,'contact' => NULL,'notes' => NULL,'created_at' => '2021-11-18 09:16:00','updated_at' => '2021-11-18 09:16:00','user_id' => '1','deleted_at' => NULL,'zip' => NULL,'url' => 'http://','image' => NULL),
        ));
        
        
    }
}