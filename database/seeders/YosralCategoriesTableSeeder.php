<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class YosralCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            array(
                'id'=>'1',
                'name'=>'Personal Computer',
                'created_at'=>'2021-11-18 04:03:07',
                'updated_at'=>'2021-11-18 04:03:07',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'2',
                'name'=>'Scanner',
                'created_at'=>'2021-11-18 04:03:30',
                'updated_at'=>'2021-11-18 04:03:30',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'3',
                'name'=>'Laptop',
                'created_at'=>'2021-11-18 04:03:44',
                'updated_at'=>'2021-11-18 04:03:44',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'4',
                'name'=>'Monitor',
                'created_at'=>'2021-11-18 04:03:59',
                'updated_at'=>'2021-11-18 04:03:59',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'5',
                'name'=>'Harddisk External',
                'created_at'=>'2021-11-18 04:05:01',
                'updated_at'=>'2021-11-18 04:05:01',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'6',
                'name'=>'UPS',
                'created_at'=>'2021-11-18 04:05:12',
                'updated_at'=>'2021-11-18 04:05:12',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'7',
                'name'=>'Printer',
                'created_at'=>'2021-11-18 04:05:25',
                'updated_at'=>'2021-11-18 04:05:25',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'8',
                'name'=>'Tablet-PC',
                'created_at'=>'2021-11-18 04:05:41',
                'updated_at'=>'2021-11-18 04:05:41',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
            array(
                'id'=>'9',
                'name'=>'GPS',
                'created_at'=>'2021-11-18 04:05:56',
                'updated_at'=>'2021-11-18 04:05:56',
                'user_id'=>'1',
                'deleted_at'=>null,
                'eula_text'=>null,
                'use_default_eula'=>'0',
                'require_acceptance'=>'0',
                'category_type'=>'asset',
                'checkin_email'=>'0',
                'image'=>null
            ),
        ));
        
        
    }
}