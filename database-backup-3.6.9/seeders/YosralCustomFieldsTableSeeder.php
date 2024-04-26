<?php

use Illuminate\Database\Seeder;

class YosralCustomFieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('custom_fields')->delete();
        
        \DB::table('custom_fields')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Software Office',
                'format' => '',
                'element' => 'listbox',
                'created_at' => '2021-09-16 15:49:26',
                'updated_at' => '2021-09-23 10:38:08',
                'user_id' => 1,
                'field_values' => 'Microsoft Office 2019
Microsoft Office 2013
Microsoft Office 2010
Microsoft Office 2007
Microsoft Office 2003
Microsoft Office 2000
Office Free
Tanpa Office
Lainnya',
                'field_encrypted' => 0,
                'db_column' => '_snipeit_software_office_1',
                'help_text' => NULL,
                'show_in_email' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sistem Operasi',
                'format' => '',
                'element' => 'listbox',
                'created_at' => '2021-09-22 17:45:38',
                'updated_at' => '2021-09-22 17:47:48',
                'user_id' => 1,
                'field_values' => 'Windows XP
Windows Vista
Windows 7
Windows 8
Windows 8.1
Windows 10
Windows Server
Android
MacOS
Lainnya',
                'field_encrypted' => 0,
                'db_column' => '_snipeit_sistem_operasi_2',
                'help_text' => NULL,
                'show_in_email' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Antivirus',
                'format' => '',
                'element' => 'listbox',
                'created_at' => '2021-11-29 09:45:35',
                'updated_at' => '2021-11-29 09:45:35',
                'user_id' => 1,
                'field_values' => 'Symantec Endpoint Protection
Windows Defender - Security Center Endpoint Protection
Trendmicro
Antivirus Free
Tanpa Antivirus',
                'field_encrypted' => 0,
                'db_column' => '_snipeit_antivirus_3',
                'help_text' => NULL,
                'show_in_email' => 0,
            ),
            3 => array('id' => 4,
                'name' => 'BAST',
                'format' => 'url',
                'element' => 'text',
                'created_at' => '2022-08-19 08:44:00',
                'updated_at' => '2022-08-19 08:44:00',
                'user_id' => NULL,
                'field_values' => NULL,
                'field_encrypted' => 0,
                'db_column' => '_snipeit_bast_4',
                'help_text' => 'Link dokumen BAST',
                'show_in_email' => 0,),
        ));
        
        
    }
}