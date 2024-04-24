<?php

use Illuminate\Database\Seeder;

class YosralLicensesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('licenses')->delete();
        
        \DB::table('licenses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Coba lisensi',
                'serial' => 'ajshdb3qn1n81wjand',
                'purchase_date' => '2021-09-01',
                'purchase_cost' => '1250000.00',
                'order_number' => NULL,
                'seats' => 2,
                'notes' => NULL,
                'user_id' => 1,
                'depreciation_id' => NULL,
                'created_at' => '2021-09-01 20:54:26',
                'updated_at' => '2021-09-22 19:33:04',
                'deleted_at' => NULL,
                'license_name' => NULL,
                'license_email' => NULL,
                'depreciate' => NULL,
                'supplier_id' => NULL,
                'mulaiberlaku' => '2021-09-01',
                'expiration_date' => '2021-09-18',
                'purchase_order' => NULL,
                'termination_date' => NULL,
                'maintained' => 0,
                'reassignable' => 1,
                'company_id' => 3,
                'manufacturer_id' => NULL,
                'category_id' => 1,
            ),
        ));
        
        
    }
}