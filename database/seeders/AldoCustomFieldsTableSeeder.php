<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AldoCustomFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('custom_fields')->insert([
            [
                'id' => 5,
                'name' => 'BAST',
                'format' => 'url',
                'element' => 'text',
                'created_at' => '2022-08-19 08:44:00',
                'updated_at' => '2022-08-19 08:44:00',
                'user_id' => NULL,
                'field_values' => NULL,
                'field_encrypted' => 0,
                'db_column' => '_snipeit_bast_5',
                'help_text' => 'Link dokumen BAST',
                'show_in_email' => 0
            ]
        ]);
        
    }
}
