<?php

use Illuminate\Database\Seeder;

class YosralStatusLabelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_labels')->delete();
        
        \DB::table('status_labels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dalam Pemeliharaan',
                'user_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-09-22 16:42:44',
                'deleted_at' => NULL,
                'deployable' => 0,
                'pending' => 1,
                'archived' => 0,
                'notes' => 'Perangkat sedang dalam proses pemeliharaan.',
                'color' => NULL,
                'show_in_nav' => 0,
                'default_label' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Siap Dialokasikan',
                'user_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-09-22 16:43:13',
                'deleted_at' => NULL,
                'deployable' => 1,
                'pending' => 0,
                'archived' => 0,
                'notes' => 'Perangkat siap untuk dialokasikan.',
                'color' => NULL,
                'show_in_nav' => 0,
                'default_label' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Diarsipkan',
                'user_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-09-22 16:43:47',
                'deleted_at' => NULL,
                'deployable' => 0,
                'pending' => 0,
                'archived' => 1,
                'notes' => 'Perangkat telah diarsipkan.',
                'color' => NULL,
                'show_in_nav' => 0,
                'default_label' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Tidak Dapat Dialokasikan',
                'user_id' => 1,
                'created_at' => '2021-09-22 16:58:46',
                'updated_at' => '2021-09-22 17:02:11',
                'deleted_at' => NULL,
                'deployable' => 0,
                'pending' => 0,
                'archived' => 0,
                'notes' => NULL,
                'color' => NULL,
                'show_in_nav' => 0,
                'default_label' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'coba',
                'user_id' => 1,
                'created_at' => '2021-09-23 11:07:15',
                'updated_at' => '2021-09-23 11:08:03',
                'deleted_at' => '2021-09-23 11:08:03',
                'deployable' => 0,
                'pending' => 0,
                'archived' => 0,
                'notes' => NULL,
                'color' => NULL,
                'show_in_nav' => 0,
                'default_label' => 0,
            ),
        ));
        
        
    }
}