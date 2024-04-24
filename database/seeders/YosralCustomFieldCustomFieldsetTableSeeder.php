<?php

use Illuminate\Database\Seeder;

class YosralCustomFieldCustomFieldsetTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('custom_field_custom_fieldset')->delete();
        
        \DB::table('custom_field_custom_fieldset')->insert(array (
            0 => 
            array (
                'custom_field_id' => 1,
                'custom_fieldset_id' => 1,
                'order' => 0,
                'required' => 0,
            ),
            1 => 
            array (
                'custom_field_id' => 3,
                'custom_fieldset_id' => 2,
                'order' => 0,
                'required' => 0,
            ),
            2 => 
            array (
                'custom_field_id' => 2,
                'custom_fieldset_id' => 2,
                'order' => 1,
                'required' => 0,
            ),
            3 => 
            array (
                'custom_field_id' => 4,
                'custom_fieldset_id' => 2,
                'order' => 2,
                'required' => 0,
            ),
            4 => 
            array (
                'custom_field_id' => 3,
                'custom_fieldset_id' => 3,
                'order' => 0,
                'required' => 0,
            ),
            5 => 
            array (
                'custom_field_id' => 2,
                'custom_fieldset_id' => 3,
                'order' => 1,
                'required' => 0,
            ),
            6 => 
            array (
                'custom_field_id' => 4,
                'custom_fieldset_id' => 3,
                'order' => 2,
                'required' => 0,
            ),
            7 => 
            array (
                'custom_field_id' => 3,
                'custom_fieldset_id' => 4,
                'order' => 0,
                'required' => 0,
            ),
            8 => 
            array (
                'custom_field_id' => 2,
                'custom_fieldset_id' => 4,
                'order' => 1,
                'required' => 0,
            ),
            9 => 
            array (
                'custom_field_id' => 4,
                'custom_fieldset_id' => 4,
                'order' => 2,
                'required' => 0,
            ),
        ));
        
        
    }
}