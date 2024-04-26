<?php

use Illuminate\Database\Seeder;

class YosralManufacturersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('manufacturers')->delete();
        
        \DB::table('manufacturers')->insert(array (
            0 =>
            array('id' => '1','name' => 'ACER','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            1 =>
            array('id' => '2','name' => 'APC','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => '+62217504406','fax_perus' => '1500055','support_email' => NULL,'alamat' => 'PT. Schneider Electric IT Indonesia, yang beralamat di Ventura Building 7th floor, Jl. RA. Kartini Kav.26, Cilandak, Jakarta Selatan 12430','image' => NULL),
            2 =>
            array('id' => '3','name' => 'Buffalo','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            3 =>
            array('id' => '4','name' => 'Canon','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            4 =>
            array('id' => '5','name' => 'Dell','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => '1500858','fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            5 =>
            array('id' => '6','name' => 'Eaton','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            6 =>
            array('id' => '7','name' => 'Emerson Liebert','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => '081808772547 - Bp. Andri','fax_perus' => '(021) 62304197','support_email' => NULL,'alamat' => 'Harcomas Mangga Dua Lt. Dasar no 41-42','image' => NULL),
            7 =>
            array('id' => '8','name' => 'Epson','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => 'https://customer.epson.asia/customer/ewarranty.do#/wry/ID','support_phone' => '+622180866766','fax_perus' => '1500766','support_email' => NULL,'alamat' => 'Cibis Tower 9, 3rd Floor<br/>Cibis Business Park<br/>Jalan T.B. Simatupang No.2 Jakarta 12560','image' => NULL),
            8 =>
            array('id' => '9','name' => 'Fujitsu','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => '080013854878','fax_perus' => '+62215735150','support_email' => NULL,'alamat' => 'Wisma Keiai 10th Floor, Jl. Jend. Sudirman Kav.3 Jakarta - 10220','image' => NULL),
            9 =>
            array('id' => '10','name' => 'HP','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => 'https://support.hp.com/us-en/checkwarranty','support_phone' => '001 803 440 320','fax_perus' => '007 803 331 5032','support_email' => NULL,'alamat' => NULL,'image' => NULL),
            10 =>
            array('id' => '11','name' => 'IBM','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            11 =>
            array('id' => '12','name' => 'Lenovo','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => 'https://smartsupport.lenovo.com/id/en/warrantylookup','support_phone' => '+622129759240','fax_perus' => '0078033315108','support_email' => NULL,'alamat' => NULL,'image' => NULL),
            12 =>
            array('id' => '13','name' => 'MGE','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            13 =>
            array('id' => '14','name' => 'Panasonic','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            14 =>
            array('id' => '15','name' => 'Samsung','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            15 =>
            array('id' => '16','name' => 'Sony','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            16 =>
            array('id' => '17','name' => 'Toshiba','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            17 =>
            array('id' => '18','name' => 'Vektor Ablerex','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            18 =>
            array('id' => '19','name' => 'XEROX','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            19 =>
            array('id' => '20','name' => 'AOC','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            20 =>
            array('id' => '21','name' => 'ICA','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            21 =>
            array('id' => '22','name' => 'Western Digital','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            22 =>
            array('id' => '23','name' => 'Fuji Xerox','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            23 =>
            array('id' => '24','name' => 'Compaq','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            24 =>
            array('id' => '25','name' => 'Brother','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            25 =>
            array('id' => '26','name' => 'Apple','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            26 =>
            array('id' => '27','name' => 'ADATA','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => 'http://www.adata.com/en/ss/prowar-search/','support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            27 =>
            array('id' => '28','name' => 'HIT','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),
            28 =>
            array('id' => '29','name' => 'Asus','created_at' => '2021-11-18 04:03:30','updated_at' => NULL,'user_id' => '1','deleted_at' => NULL,'url' => NULL,'support_url' => NULL,'support_phone' => NULL,'fax_perus' => NULL,'support_email' => NULL,'alamat' => NULL,'image' => NULL),

        ));
        
        
    }
}