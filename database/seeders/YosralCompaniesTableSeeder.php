<?php

use Illuminate\Database\Seeder;

class YosralCompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            array (
                'id'=> '1',
                'kode_wil'=> '2100',
                'name'=> 'Biro Bina Program',
                'created_at'=> '2021-12-16 10:10:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '2',
                'kode_wil'=> '2200',
                'name'=> 'Biro Keuangan',
                'created_at'=> '2021-12-16 10:10:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '3',
                'kode_wil'=> '2300',
                'name'=> 'Biro Kepegawaian',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '4',
                'kode_wil'=> '2400',
                'name'=> 'Biro Hubungan Masyarakat dan Hukum',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '5',
                'kode_wil'=> '2500',
                'name'=> 'Biro Umum',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '6',
                'kode_wil'=> '2600',
                'name'=> 'Pusat Pendidikan dan Pelatihan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '7',
                'kode_wil'=> '2700',
                'name'=> 'Politeknik Statistika STIS',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '8',
                'kode_wil'=> '3100',
                'name'=> 'Direktorat Pengembangan Metodologi Sensus dan Survei',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '9',
                'kode_wil'=> '3200',
                'name'=> 'Direktorat Diseminasi Statistik',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '10',
                'kode_wil'=> '3300',
                'name'=> 'Direktorat Sistem Informasi Statistik',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '11',
                'kode_wil'=> '4100',
                'name'=> 'Direktorat Statistik Kependudukan dan Ketenagakerjaan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '12',
                'kode_wil'=> '4200',
                'name'=> 'Direktorat Statistik Kesejahteraan Rakyat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '13',
                'kode_wil'=> '4300',
                'name'=> 'Direktorat Statistik Ketahanan Sosial',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '14',
                'kode_wil'=> '5100',
                'name'=> 'Direktorat Statistik Tanaman Pangan, Hortikultura, dan Perkebunan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '15',
                'kode_wil'=> '5200',
                'name'=> 'Direktorat Statistik Peternakan, Perikanan, dan Kehutanan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '16',
                'kode_wil'=> '5300',
                'name'=> 'Direktorat Statistik Industri',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '17',
                'kode_wil'=> '6100',
                'name'=> 'Direktorat Statistik Distribusi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '18',
                'kode_wil'=> '6200',
                'name'=> 'Direktorat Statistik Harga',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '19',
                'kode_wil'=> '6300',
                'name'=> 'Direktorat Statistik Keuangan, Teknologi Informasi, dan Pariwisata',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '20',
                'kode_wil'=> '7100',
                'name'=> 'Direktorat Neraca Produksi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '21',
                'kode_wil'=> '7200',
                'name'=> 'Direktorat Neraca Pengeluaran',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '22',
                'kode_wil'=> '7300',
                'name'=> 'Direktorat Analisis dan Pengembangan Statistik',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '23',
                'kode_wil'=> '8100',
                'name'=> 'Inspektorat Wilayah I',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '24',
                'kode_wil'=> '8200',
                'name'=> 'Inspektorat Wilayah II',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '25',
                'kode_wil'=> '8300',
                'name'=> 'Inspektorat Wilayah III',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '26',
                'kode_wil'=> '1100',
                'name'=> 'BPS Propinsi Aceh',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '27',
                'kode_wil'=> '1200',
                'name'=> 'BPS Propinsi Sumatera Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '28',
                'kode_wil'=> '1300',
                'name'=> 'BPS Propinsi Sumatera Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '29',
                'kode_wil'=> '1400',
                'name'=> 'BPS Propinsi Riau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '30',
                'kode_wil'=> '1500',
                'name'=> 'BPS Propinsi Jambi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '31',
                'kode_wil'=> '1600',
                'name'=> 'BPS Propinsi Sumatera Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '32',
                'kode_wil'=> '1700',
                'name'=> 'BPS Propinsi Bengkulu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '33',
                'kode_wil'=> '1800',
                'name'=> 'BPS Propinsi Lampung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '34',
                'kode_wil'=> '1900',
                'name'=> 'BPS Propinsi Kep. Bangka Belitung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '35',
                'kode_wil'=> '2100',
                'name'=> 'BPS Propinsi Kepulauan Riau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '36',
                'kode_wil'=> '3100',
                'name'=> 'BPS Propinsi Dki Jakarta',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '37',
                'kode_wil'=> '3200',
                'name'=> 'BPS Propinsi Jawa Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '38',
                'kode_wil'=> '3300',
                'name'=> 'BPS Propinsi Jawa Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '39',
                'kode_wil'=> '3400',
                'name'=> 'BPS Propinsi Di Yogyakarta',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '40',
                'kode_wil'=> '3500',
                'name'=> 'BPS Propinsi Jawa Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '41',
                'kode_wil'=> '3600',
                'name'=> 'BPS Propinsi Banten',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '42',
                'kode_wil'=> '5100',
                'name'=> 'BPS Propinsi Bali',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '43',
                'kode_wil'=> '5200',
                'name'=> 'BPS Propinsi Nusa Tenggara Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '44',
                'kode_wil'=> '5300',
                'name'=> 'BPS Propinsi Nusa Tenggara Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '45',
                'kode_wil'=> '6100',
                'name'=> 'BPS Propinsi Kalimantan Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '46',
                'kode_wil'=> '6200',
                'name'=> 'BPS Propinsi Kalimantan Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '47',
                'kode_wil'=> '6300',
                'name'=> 'BPS Propinsi Kalimantan Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '48',
                'kode_wil'=> '6400',
                'name'=> 'BPS Propinsi Kalimantan Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '49',
                'kode_wil'=> '6500',
                'name'=> 'BPS Propinsi Kalimantan Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '50',
                'kode_wil'=> '7100',
                'name'=> 'BPS Propinsi Sulawesi Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '51',
                'kode_wil'=> '7200',
                'name'=> 'BPS Propinsi Sulawesi Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '52',
                'kode_wil'=> '7300',
                'name'=> 'BPS Propinsi Sulawesi Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '53',
                'kode_wil'=> '7400',
                'name'=> 'BPS Propinsi Sulawesi Tenggara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '54',
                'kode_wil'=> '7500',
                'name'=> 'BPS Propinsi Gorontalo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '55',
                'kode_wil'=> '7600',
                'name'=> 'BPS Propinsi Sulawesi Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '56',
                'kode_wil'=> '8100',
                'name'=> 'BPS Propinsi Maluku',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '57',
                'kode_wil'=> '8200',
                'name'=> 'BPS Propinsi Maluku Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '58',
                'kode_wil'=> '9100',
                'name'=> 'BPS Propinsi Papua Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '59',
                'kode_wil'=> '9400',
                'name'=> 'BPS Propinsi Papua',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '60',
                'kode_wil'=> '1101',
                'name'=> 'BPS Kabupaten Simeulue',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '61',
                'kode_wil'=> '1102',
                'name'=> 'BPS Kabupaten Aceh Singkil',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '62',
                'kode_wil'=> '1103',
                'name'=> 'BPS Kabupaten Aceh Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '63',
                'kode_wil'=> '1104',
                'name'=> 'BPS Kabupaten Aceh Tenggara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '64',
                'kode_wil'=> '1105',
                'name'=> 'BPS Kabupaten Aceh Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '65',
                'kode_wil'=> '1106',
                'name'=> 'BPS Kabupaten Aceh Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '66',
                'kode_wil'=> '1107',
                'name'=> 'BPS Kabupaten Aceh Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '67',
                'kode_wil'=> '1108',
                'name'=> 'BPS Kabupaten Aceh Besar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '68',
                'kode_wil'=> '1109',
                'name'=> 'BPS Kabupaten Pidie',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '69',
                'kode_wil'=> '1110',
                'name'=> 'BPS Kabupaten Bireuen',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '70',
                'kode_wil'=> '1111',
                'name'=> 'BPS Kabupaten Aceh Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '71',
                'kode_wil'=> '1112',
                'name'=> 'BPS Kabupaten Aceh Barat Daya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '72',
                'kode_wil'=> '1113',
                'name'=> 'BPS Kabupaten Gayo Lues',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '73',
                'kode_wil'=> '1114',
                'name'=> 'BPS Kabupaten Aceh Tamiang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '74',
                'kode_wil'=> '1115',
                'name'=> 'BPS Kabupaten Nagan Raya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '75',
                'kode_wil'=> '1116',
                'name'=> 'BPS Kabupaten Aceh Jaya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '76',
                'kode_wil'=> '1117',
                'name'=> 'BPS Kabupaten Bener Meriah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '77',
                'kode_wil'=> '1118',
                'name'=> 'BPS Kabupaten Pidie Jaya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '78',
                'kode_wil'=> '1171',
                'name'=> 'BPS Kota Banda Aceh',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '79',
                'kode_wil'=> '1172',
                'name'=> 'BPS Kota Sabang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '80',
                'kode_wil'=> '1173',
                'name'=> 'BPS Kota Langsa',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '81',
                'kode_wil'=> '1174',
                'name'=> 'BPS Kota Lhokseumawe',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '82',
                'kode_wil'=> '1175',
                'name'=> 'BPS Kota Subulussalam',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '83',
                'kode_wil'=> '1201',
                'name'=> 'BPS Kabupaten Nias',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '84',
                'kode_wil'=> '1202',
                'name'=> 'BPS Kabupaten Mandailing Natal',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '85',
                'kode_wil'=> '1203',
                'name'=> 'BPS Kabupaten Tapanuli Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '86',
                'kode_wil'=> '1204',
                'name'=> 'BPS Kabupaten Tapanuli Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '87',
                'kode_wil'=> '1205',
                'name'=> 'BPS Kabupaten Tapanuli Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '88',
                'kode_wil'=> '1206',
                'name'=> 'BPS Kabupaten Toba Samosir',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '89',
                'kode_wil'=> '1207',
                'name'=> 'BPS Kabupaten Labuhan Batu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '90',
                'kode_wil'=> '1208',
                'name'=> 'BPS Kabupaten Asahan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '91',
                'kode_wil'=> '1209',
                'name'=> 'BPS Kabupaten Simalungun',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '92',
                'kode_wil'=> '1210',
                'name'=> 'BPS Kabupaten Dairi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '93',
                'kode_wil'=> '1211',
                'name'=> 'BPS Kabupaten Karo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '94',
                'kode_wil'=> '1212',
                'name'=> 'BPS Kabupaten Deli Serdang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '95',
                'kode_wil'=> '1213',
                'name'=> 'BPS Kabupaten Langkat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '96',
                'kode_wil'=> '1214',
                'name'=> 'BPS Kabupaten Nias Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '97',
                'kode_wil'=> '1215',
                'name'=> 'BPS Kabupaten Humbang Hasundutan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '98',
                'kode_wil'=> '1216',
                'name'=> 'BPS Kabupaten Pakpak Bharat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '99',
                'kode_wil'=> '1217',
                'name'=> 'BPS Kabupaten Samosir',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '100',
                'kode_wil'=> '1218',
                'name'=> 'BPS Kabupaten Serdang Bedagai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '101',
                'kode_wil'=> '1219',
                'name'=> 'BPS Kabupaten Batu Bara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '102',
                'kode_wil'=> '1220',
                'name'=> 'BPS Kabupaten Padang Lawas Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '103',
                'kode_wil'=> '1221',
                'name'=> 'BPS Kabupaten Padang Lawas',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '104',
                'kode_wil'=> '1222',
                'name'=> 'BPS Kabupaten Labuhan Batu Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '105',
                'kode_wil'=> '1223',
                'name'=> 'BPS Kabupaten Labuhan Batu Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '106',
                'kode_wil'=> '1271',
                'name'=> 'BPS Kota Sibolga',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '107',
                'kode_wil'=> '1272',
                'name'=> 'BPS Kota Tanjung Balai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '108',
                'kode_wil'=> '1273',
                'name'=> 'BPS Kota Pematang Siantar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '109',
                'kode_wil'=> '1274',
                'name'=> 'BPS Kota Tebing Tinggi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '110',
                'kode_wil'=> '1275',
                'name'=> 'BPS Kota Medan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '111',
                'kode_wil'=> '1276',
                'name'=> 'BPS Kota Binjai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '112',
                'kode_wil'=> '1277',
                'name'=> 'BPS Kota Padangsidimpuan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '113',
                'kode_wil'=> '1278',
                'name'=> 'BPS Kota Gunungsitoli',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '114',
                'kode_wil'=> '1301',
                'name'=> 'BPS Kabupaten Kepulauan Mentawai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '115',
                'kode_wil'=> '1302',
                'name'=> 'BPS Kabupaten Pesisir Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '116',
                'kode_wil'=> '1303',
                'name'=> 'BPS Kabupaten Solok',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '117',
                'kode_wil'=> '1304',
                'name'=> 'BPS Kabupaten Sijunjung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '118',
                'kode_wil'=> '1305',
                'name'=> 'BPS Kabupaten Tanah Datar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '119',
                'kode_wil'=> '1306',
                'name'=> 'BPS Kabupaten Padang Pariaman',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '120',
                'kode_wil'=> '1307',
                'name'=> 'BPS Kabupaten Agam',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '121',
                'kode_wil'=> '1308',
                'name'=> 'BPS Kabupaten Lima Puluh Kota',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '122',
                'kode_wil'=> '1309',
                'name'=> 'BPS Kabupaten Pasaman',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '123',
                'kode_wil'=> '1310',
                'name'=> 'BPS Kabupaten Solok Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '124',
                'kode_wil'=> '1311',
                'name'=> 'BPS Kabupaten Dharmasraya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '125',
                'kode_wil'=> '1312',
                'name'=> 'BPS Kabupaten Pasaman Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '126',
                'kode_wil'=> '1371',
                'name'=> 'BPS Kota Padang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '127',
                'kode_wil'=> '1372',
                'name'=> 'BPS Kota Solok',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '128',
                'kode_wil'=> '1373',
                'name'=> 'BPS Kota Sawah Lunto',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '129',
                'kode_wil'=> '1374',
                'name'=> 'BPS Kota Padang Panjang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '130',
                'kode_wil'=> '1375',
                'name'=> 'BPS Kota Bukittinggi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '131',
                'kode_wil'=> '1376',
                'name'=> 'BPS Kota Payakumbuh',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '132',
                'kode_wil'=> '1377',
                'name'=> 'BPS Kota Pariaman',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '133',
                'kode_wil'=> '1401',
                'name'=> 'BPS Kabupaten Kuantan Singingi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '134',
                'kode_wil'=> '1402',
                'name'=> 'BPS Kabupaten Indragiri Hulu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '135',
                'kode_wil'=> '1403',
                'name'=> 'BPS Kabupaten Indragiri Hilir',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '136',
                'kode_wil'=> '1404',
                'name'=> 'BPS Kabupaten Pelalawan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '137',
                'kode_wil'=> '1405',
                'name'=> 'BPS Kabupaten Siak',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '138',
                'kode_wil'=> '1406',
                'name'=> 'BPS Kabupaten Kampar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '139',
                'kode_wil'=> '1407',
                'name'=> 'BPS Kabupaten Rokan Hulu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '140',
                'kode_wil'=> '1408',
                'name'=> 'BPS Kabupaten Bengkalis',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '141',
                'kode_wil'=> '1409',
                'name'=> 'BPS Kabupaten Rokan Hilir',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '142',
                'kode_wil'=> '1410',
                'name'=> 'BPS Kabupaten Kepulauan Meranti',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '143',
                'kode_wil'=> '1471',
                'name'=> 'BPS Kota Pekanbaru',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '144',
                'kode_wil'=> '1743',
                'name'=> 'BPS Kota Dumai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '145',
                'kode_wil'=> '1501',
                'name'=> 'BPS Kabupaten Kerinci',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '146',
                'kode_wil'=> '1502',
                'name'=> 'BPS Kabupaten Merangin',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '147',
                'kode_wil'=> '1503',
                'name'=> 'BPS Kabupaten Sarolangun',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '148',
                'kode_wil'=> '1504',
                'name'=> 'BPS Kabupaten Batang Hari',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '149',
                'kode_wil'=> '1505',
                'name'=> 'BPS Kabupaten Muaro Jambi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '150',
                'kode_wil'=> '1506',
                'name'=> 'BPS Kabupaten Tanjung Jabung Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '151',
                'kode_wil'=> '1507',
                'name'=> 'BPS Kabupaten Tanjung Jabung Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '152',
                'kode_wil'=> '1508',
                'name'=> 'BPS Kabupaten Tebo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '153',
                'kode_wil'=> '1509',
                'name'=> 'BPS Kabupaten Bungo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '154',
                'kode_wil'=> '1871',
                'name'=> 'BPS Kota Jambi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '155',
                'kode_wil'=> '1572',
                'name'=> 'BPS Kota Sungai Penuh',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '156',
                'kode_wil'=> '1601',
                'name'=> 'BPS Kabupaten Ogan Komering Ulu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '157',
                'kode_wil'=> '1602',
                'name'=> 'BPS Kabupaten Ogan Komering Ilir',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '158',
                'kode_wil'=> '1603',
                'name'=> 'BPS Kabupaten Muara Enim',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '159',
                'kode_wil'=> '1604',
                'name'=> 'BPS Kabupaten Lahat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '160',
                'kode_wil'=> '1605',
                'name'=> 'BPS Kabupaten Musi Rawas',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '161',
                'kode_wil'=> '1606',
                'name'=> 'BPS Kabupaten Musi Banyuasin',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '162',
                'kode_wil'=> '1607',
                'name'=> 'BPS Kabupaten Banyu Asin',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '163',
                'kode_wil'=> '1608',
                'name'=> 'BPS Kabupaten Ogan Komering Ulu Se',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '164',
                'kode_wil'=> '1609',
                'name'=> 'BPS Kabupaten Ogan Komering Ulu Ti',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '165',
                'kode_wil'=> '1610',
                'name'=> 'BPS Kabupaten Ogan Ilir',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '166',
                'kode_wil'=> '1611',
                'name'=> 'BPS Kabupaten Empat Lawang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '167',
                'kode_wil'=> '1671',
                'name'=> 'BPS Kota Palembang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '168',
                'kode_wil'=> '1672',
                'name'=> 'BPS Kota Prabumulih',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '169',
                'kode_wil'=> '1673',
                'name'=> 'BPS Kota Pagar Alam',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '170',
                'kode_wil'=> '1674',
                'name'=> 'BPS Kota Lubuklinggau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '171',
                'kode_wil'=> '1701',
                'name'=> 'BPS Kabupaten Bengkulu Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '172',
                'kode_wil'=> '1702',
                'name'=> 'BPS Kabupaten Rejang Lebong',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '173',
                'kode_wil'=> '1703',
                'name'=> 'BPS Kabupaten Bengkulu Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '174',
                'kode_wil'=> '1704',
                'name'=> 'BPS Kabupaten Kaur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '175',
                'kode_wil'=> '1705',
                'name'=> 'BPS Kabupaten Seluma',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '176',
                'kode_wil'=> '1706',
                'name'=> 'BPS Kabupaten Mukomuko',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '177',
                'kode_wil'=> '1707',
                'name'=> 'BPS Kabupaten Lebong',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '178',
                'kode_wil'=> '1708',
                'name'=> 'BPS Kabupaten Kepahiang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '179',
                'kode_wil'=> '1709',
                'name'=> 'BPS Kabupaten Bengkulu Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '180',
                'kode_wil'=> '1771',
                'name'=> 'BPS Kota Bengkulu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '181',
                'kode_wil'=> '1801',
                'name'=> 'BPS Kabupaten Lampung Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '182',
                'kode_wil'=> '1802',
                'name'=> 'BPS Kabupaten Tanggamus',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '183',
                'kode_wil'=> '1803',
                'name'=> 'BPS Kabupaten Lampung Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '184',
                'kode_wil'=> '1804',
                'name'=> 'BPS Kabupaten Lampung Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '185',
                'kode_wil'=> '1805',
                'name'=> 'BPS Kabupaten Lampung Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '186',
                'kode_wil'=> '1806',
                'name'=> 'BPS Kabupaten Lampung Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '187',
                'kode_wil'=> '1807',
                'name'=> 'BPS Kabupaten Way Kanan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '188',
                'kode_wil'=> '1808',
                'name'=> 'BPS Kabupaten Tulangbawang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '189',
                'kode_wil'=> '1809',
                'name'=> 'BPS Kabupaten Pesawaran',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '190',
                'kode_wil'=> '1810',
                'name'=> 'BPS Kabupaten Pringsewu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '191',
                'kode_wil'=> '1811',
                'name'=> 'BPS Kabupaten Mesuji',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '192',
                'kode_wil'=> '1812',
                'name'=> 'BPS Kabupaten Tulang Bawang Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '193',
                'kode_wil'=> '1871',
                'name'=> 'BPS Kota Bandar Lampung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '194',
                'kode_wil'=> '1872',
                'name'=> 'BPS Kota Metro',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '195',
                'kode_wil'=> '1901',
                'name'=> 'BPS Kabupaten Bangka',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '196',
                'kode_wil'=> '1902',
                'name'=> 'BPS Kabupaten Belitung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '197',
                'kode_wil'=> '1903',
                'name'=> 'BPS Kabupaten Bangka Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '198',
                'kode_wil'=> '1904',
                'name'=> 'BPS Kabupaten Bangka Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '199',
                'kode_wil'=> '1905',
                'name'=> 'BPS Kabupaten Bangka Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '200',
                'kode_wil'=> '1906',
                'name'=> 'BPS Kabupaten Belitung Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '201',
                'kode_wil'=> '1971',
                'name'=> 'BPS Kota Pangkal Pinang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '202',
                'kode_wil'=> '2101',
                'name'=> 'BPS Kabupaten Karimun',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '203',
                'kode_wil'=> '2102',
                'name'=> 'BPS Kabupaten Bintan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '204',
                'kode_wil'=> '2103',
                'name'=> 'BPS Kabupaten Natuna',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '205',
                'kode_wil'=> '2104',
                'name'=> 'BPS Kabupaten Lingga',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '206',
                'kode_wil'=> '2105',
                'name'=> 'BPS Kabupaten Kepulauan Anambas',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '207',
                'kode_wil'=> '2171',
                'name'=> 'BPS Kota Batam',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '208',
                'kode_wil'=> '2172',
                'name'=> 'BPS Kota Tanjung Pinang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '209',
                'kode_wil'=> '3101',
                'name'=> 'BPS Kabupaten Kepulauan Seribu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '210',
                'kode_wil'=> '3171',
                'name'=> 'BPS Kota Jakarta Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '211',
                'kode_wil'=> '3172',
                'name'=> 'BPS Kota Jakarta Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '212',
                'kode_wil'=> '3173',
                'name'=> 'BPS Kota Jakarta Pusat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '213',
                'kode_wil'=> '3174',
                'name'=> 'BPS Kota Jakarta Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '214',
                'kode_wil'=> '3175',
                'name'=> 'BPS Kota Jakarta Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '215',
                'kode_wil'=> '3201',
                'name'=> 'BPS Kabupaten Bogor',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '216',
                'kode_wil'=> '3202',
                'name'=> 'BPS Kabupaten Sukabumi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '217',
                'kode_wil'=> '3203',
                'name'=> 'BPS Kabupaten Cianjur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '218',
                'kode_wil'=> '3204',
                'name'=> 'BPS Kabupaten Bandung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '219',
                'kode_wil'=> '3205',
                'name'=> 'BPS Kabupaten Garut',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '220',
                'kode_wil'=> '3206',
                'name'=> 'BPS Kabupaten Tasikmalaya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '221',
                'kode_wil'=> '3207',
                'name'=> 'BPS Kabupaten Ciamis',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '222',
                'kode_wil'=> '3208',
                'name'=> 'BPS Kabupaten Kuningan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '223',
                'kode_wil'=> '3209',
                'name'=> 'BPS Kabupaten Cirebon',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '224',
                'kode_wil'=> '3210',
                'name'=> 'BPS Kabupaten Majalengka',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '225',
                'kode_wil'=> '3211',
                'name'=> 'BPS Kabupaten Sumedang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '226',
                'kode_wil'=> '3212',
                'name'=> 'BPS Kabupaten Indramayu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '227',
                'kode_wil'=> '3213',
                'name'=> 'BPS Kabupaten Subang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '228',
                'kode_wil'=> '3214',
                'name'=> 'BPS Kabupaten Purwakarta',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '229',
                'kode_wil'=> '3215',
                'name'=> 'BPS Kabupaten Karawang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '230',
                'kode_wil'=> '3216',
                'name'=> 'BPS Kabupaten Bekasi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '231',
                'kode_wil'=> '3217',
                'name'=> 'BPS Kabupaten Bandung Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '232',
                'kode_wil'=> '3271',
                'name'=> 'BPS Kota Bogor',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '233',
                'kode_wil'=> '3272',
                'name'=> 'BPS Kota Sukabumi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '234',
                'kode_wil'=> '3273',
                'name'=> 'BPS Kota Bandung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '235',
                'kode_wil'=> '3274',
                'name'=> 'BPS Kota Cirebon',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '236',
                'kode_wil'=> '3275',
                'name'=> 'BPS Kota Bekasi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '237',
                'kode_wil'=> '3276',
                'name'=> 'BPS Kota Depok',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '238',
                'kode_wil'=> '3277',
                'name'=> 'BPS Kota Cimahi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '239',
                'kode_wil'=> '3278',
                'name'=> 'BPS Kota Tasikmalaya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '240',
                'kode_wil'=> '3279',
                'name'=> 'BPS Kota Banjar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '241',
                'kode_wil'=> '3301',
                'name'=> 'BPS Kabupaten Cilacap',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '242',
                'kode_wil'=> '3302',
                'name'=> 'BPS Kabupaten Banyumas',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '243',
                'kode_wil'=> '3303',
                'name'=> 'BPS Kabupaten Purbalingga',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '244',
                'kode_wil'=> '3304',
                'name'=> 'BPS Kabupaten Banjarnegara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '245',
                'kode_wil'=> '3305',
                'name'=> 'BPS Kabupaten Kebumen',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '246',
                'kode_wil'=> '3306',
                'name'=> 'BPS Kabupaten Purworejo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '247',
                'kode_wil'=> '3307',
                'name'=> 'BPS Kabupaten Wonosobo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '248',
                'kode_wil'=> '3308',
                'name'=> 'BPS Kabupaten Magelang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '249',
                'kode_wil'=> '3309',
                'name'=> 'BPS Kabupaten Boyolali',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '250',
                'kode_wil'=> '3310',
                'name'=> 'BPS Kabupaten Klaten',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '251',
                'kode_wil'=> '3311',
                'name'=> 'BPS Kabupaten Sukoharjo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '252',
                'kode_wil'=> '3312',
                'name'=> 'BPS Kabupaten Wonogiri',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '253',
                'kode_wil'=> '3313',
                'name'=> 'BPS Kabupaten Karanganyar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '254',
                'kode_wil'=> '3314',
                'name'=> 'BPS Kabupaten Sragen',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '255',
                'kode_wil'=> '3315',
                'name'=> 'BPS Kabupaten Grobogan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '256',
                'kode_wil'=> '3316',
                'name'=> 'BPS Kabupaten Blora',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '257',
                'kode_wil'=> '3317',
                'name'=> 'BPS Kabupaten Rembang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '258',
                'kode_wil'=> '3318',
                'name'=> 'BPS Kabupaten Pati',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '259',
                'kode_wil'=> '3319',
                'name'=> 'BPS Kabupaten Kudus',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '260',
                'kode_wil'=> '3320',
                'name'=> 'BPS Kabupaten Jepara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '261',
                'kode_wil'=> '3321',
                'name'=> 'BPS Kabupaten Demak',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '262',
                'kode_wil'=> '3322',
                'name'=> 'BPS Kabupaten Semarang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '263',
                'kode_wil'=> '3323',
                'name'=> 'BPS Kabupaten Temanggung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '264',
                'kode_wil'=> '3324',
                'name'=> 'BPS Kabupaten Kendal',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '265',
                'kode_wil'=> '3325',
                'name'=> 'BPS Kabupaten Batang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '266',
                'kode_wil'=> '3326',
                'name'=> 'BPS Kabupaten Pekalongan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '267',
                'kode_wil'=> '3327',
                'name'=> 'BPS Kabupaten Pemalang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '268',
                'kode_wil'=> '3328',
                'name'=> 'BPS Kabupaten Tegal',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '269',
                'kode_wil'=> '3329',
                'name'=> 'BPS Kabupaten Brebes',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '270',
                'kode_wil'=> '3371',
                'name'=> 'BPS Kota Magelang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '271',
                'kode_wil'=> '3372',
                'name'=> 'BPS Kota Surakarta',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '272',
                'kode_wil'=> '3373',
                'name'=> 'BPS Kota Salatiga',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '273',
                'kode_wil'=> '3374',
                'name'=> 'BPS Kota Semarang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '274',
                'kode_wil'=> '3375',
                'name'=> 'BPS Kota Pekalongan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '275',
                'kode_wil'=> '3376',
                'name'=> 'BPS Kota Tegal',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '276',
                'kode_wil'=> '3401',
                'name'=> 'BPS Kabupaten Kulon Progo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '277',
                'kode_wil'=> '3402',
                'name'=> 'BPS Kabupaten Bantul',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '278',
                'kode_wil'=> '3403',
                'name'=> 'BPS Kabupaten Gunungkidul',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '279',
                'kode_wil'=> '3404',
                'name'=> 'BPS Kabupaten Sleman',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '280',
                'kode_wil'=> '3471',
                'name'=> 'BPS Kota Yogyakarta',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '281',
                'kode_wil'=> '3501',
                'name'=> 'BPS Kabupaten Pacitan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '282',
                'kode_wil'=> '3502',
                'name'=> 'BPS Kabupaten Ponorogo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '283',
                'kode_wil'=> '3503',
                'name'=> 'BPS Kabupaten Trenggalek',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '284',
                'kode_wil'=> '3504',
                'name'=> 'BPS Kabupaten Tulungagung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '285',
                'kode_wil'=> '3505',
                'name'=> 'BPS Kabupaten Blitar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '286',
                'kode_wil'=> '3506',
                'name'=> 'BPS Kabupaten Kediri',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '287',
                'kode_wil'=> '3507',
                'name'=> 'BPS Kabupaten Malang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '288',
                'kode_wil'=> '3508',
                'name'=> 'BPS Kabupaten Lumajang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '289',
                'kode_wil'=> '3509',
                'name'=> 'BPS Kabupaten Jember',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '290',
                'kode_wil'=> '3510',
                'name'=> 'BPS Kabupaten Banyuwangi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '291',
                'kode_wil'=> '3511',
                'name'=> 'BPS Kabupaten Bondowoso',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '292',
                'kode_wil'=> '3512',
                'name'=> 'BPS Kabupaten Situbondo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '293',
                'kode_wil'=> '3513',
                'name'=> 'BPS Kabupaten Probolinggo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '294',
                'kode_wil'=> '3514',
                'name'=> 'BPS Kabupaten Pasuruan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '295',
                'kode_wil'=> '3515',
                'name'=> 'BPS Kabupaten Sidoarjo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '296',
                'kode_wil'=> '3516',
                'name'=> 'BPS Kabupaten Mojokerto',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '297',
                'kode_wil'=> '3517',
                'name'=> 'BPS Kabupaten Jombang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '298',
                'kode_wil'=> '3518',
                'name'=> 'BPS Kabupaten Nganjuk',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '299',
                'kode_wil'=> '3519',
                'name'=> 'BPS Kabupaten Madiun',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '300',
                'kode_wil'=> '3520',
                'name'=> 'BPS Kabupaten Magetan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '301',
                'kode_wil'=> '3521',
                'name'=> 'BPS Kabupaten Ngawi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '302',
                'kode_wil'=> '3522',
                'name'=> 'BPS Kabupaten Bojonegoro',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '303',
                'kode_wil'=> '3523',
                'name'=> 'BPS Kabupaten Tuban',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '304',
                'kode_wil'=> '3524',
                'name'=> 'BPS Kabupaten Lamongan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '305',
                'kode_wil'=> '3525',
                'name'=> 'BPS Kabupaten Gresik',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '306',
                'kode_wil'=> '3526',
                'name'=> 'BPS Kabupaten Bangkalan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '307',
                'kode_wil'=> '3527',
                'name'=> 'BPS Kabupaten Sampang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '308',
                'kode_wil'=> '3528',
                'name'=> 'BPS Kabupaten Pamekasan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '309',
                'kode_wil'=> '3529',
                'name'=> 'BPS Kabupaten Sumenep',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '310',
                'kode_wil'=> '3571',
                'name'=> 'BPS Kota Kediri',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '311',
                'kode_wil'=> '3572',
                'name'=> 'BPS Kota Blitar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '312',
                'kode_wil'=> '3573',
                'name'=> 'BPS Kota Malang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '313',
                'kode_wil'=> '3574',
                'name'=> 'BPS Kota Probolinggo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '314',
                'kode_wil'=> '3575',
                'name'=> 'BPS Kota Pasuruan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '315',
                'kode_wil'=> '3576',
                'name'=> 'BPS Kota Mojokerto',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '316',
                'kode_wil'=> '3577',
                'name'=> 'BPS Kota Madiun',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '317',
                'kode_wil'=> '3578',
                'name'=> 'BPS Kota Surabaya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '318',
                'kode_wil'=> '3579',
                'name'=> 'BPS Kota Batu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '319',
                'kode_wil'=> '3601',
                'name'=> 'BPS Kabupaten Pandeglang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '320',
                'kode_wil'=> '3602',
                'name'=> 'BPS Kabupaten Lebak',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '321',
                'kode_wil'=> '3603',
                'name'=> 'BPS Kabupaten Tangerang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '322',
                'kode_wil'=> '3604',
                'name'=> 'BPS Kabupaten Serang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '323',
                'kode_wil'=> '3671',
                'name'=> 'BPS Kota Tangerang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '324',
                'kode_wil'=> '3672',
                'name'=> 'BPS Kota Cilegon',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '325',
                'kode_wil'=> '3673',
                'name'=> 'BPS Kota Serang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '326',
                'kode_wil'=> '3674',
                'name'=> 'BPS Kota Tangerang Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '327',
                'kode_wil'=> '5101',
                'name'=> 'BPS Kabupaten Jembrana',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '328',
                'kode_wil'=> '5102',
                'name'=> 'BPS Kabupaten Tabanan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '329',
                'kode_wil'=> '5103',
                'name'=> 'BPS Kabupaten Badung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '330',
                'kode_wil'=> '5104',
                'name'=> 'BPS Kabupaten Gianyar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '331',
                'kode_wil'=> '5105',
                'name'=> 'BPS Kabupaten Klungkung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '332',
                'kode_wil'=> '5106',
                'name'=> 'BPS Kabupaten Bangli',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '333',
                'kode_wil'=> '5107',
                'name'=> 'BPS Kabupaten Karangasem',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '334',
                'kode_wil'=> '5108',
                'name'=> 'BPS Kabupaten Buleleng',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '335',
                'kode_wil'=> '5171',
                'name'=> 'BPS Kota Denpasar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '336',
                'kode_wil'=> '5201',
                'name'=> 'BPS Kabupaten Lombok Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '337',
                'kode_wil'=> '5202',
                'name'=> 'BPS Kabupaten Lombok Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '338',
                'kode_wil'=> '5203',
                'name'=> 'BPS Kabupaten Lombok Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '339',
                'kode_wil'=> '5204',
                'name'=> 'BPS Kabupaten Sumbawa',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '340',
                'kode_wil'=> '5205',
                'name'=> 'BPS Kabupaten Dompu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '341',
                'kode_wil'=> '5206',
                'name'=> 'BPS Kabupaten Bima',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '342',
                'kode_wil'=> '5207',
                'name'=> 'BPS Kabupaten Sumbawa Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '343',
                'kode_wil'=> '5208',
                'name'=> 'BPS Kabupaten Lombok Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '344',
                'kode_wil'=> '5271',
                'name'=> 'BPS Kota Mataram',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '345',
                'kode_wil'=> '5272',
                'name'=> 'BPS Kota Bima',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '346',
                'kode_wil'=> '5301',
                'name'=> 'BPS Kabupaten Sumba Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '347',
                'kode_wil'=> '5302',
                'name'=> 'BPS Kabupaten Sumba Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '348',
                'kode_wil'=> '5303',
                'name'=> 'BPS Kabupaten Kupang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '349',
                'kode_wil'=> '5304',
                'name'=> 'BPS Kabupaten Timor Tengah Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '350',
                'kode_wil'=> '5305',
                'name'=> 'BPS Kabupaten Timor Tengah Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '351',
                'kode_wil'=> '5306',
                'name'=> 'BPS Kabupaten Belu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '352',
                'kode_wil'=> '5307',
                'name'=> 'BPS Kabupaten Alor',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '353',
                'kode_wil'=> '5308',
                'name'=> 'BPS Kabupaten Lembata',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '354',
                'kode_wil'=> '5309',
                'name'=> 'BPS Kabupaten Flores Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '355',
                'kode_wil'=> '5310',
                'name'=> 'BPS Kabupaten Sikka',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '356',
                'kode_wil'=> '5311',
                'name'=> 'BPS Kabupaten Ende',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '357',
                'kode_wil'=> '5312',
                'name'=> 'BPS Kabupaten Ngada',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '358',
                'kode_wil'=> '5313',
                'name'=> 'BPS Kabupaten Manggarai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '359',
                'kode_wil'=> '5314',
                'name'=> 'BPS Kabupaten Rote Ndao',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '360',
                'kode_wil'=> '5315',
                'name'=> 'BPS Kabupaten Manggarai Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '361',
                'kode_wil'=> '5317',
                'name'=> 'BPS Kabupaten Sumba Barat Daya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '362',
                'kode_wil'=> '5318',
                'name'=> 'BPS Kabupaten Nagekeo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '363',
                'kode_wil'=> '5319',
                'name'=> 'BPS Kabupaten Manggarai Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '364',
                'kode_wil'=> '5371',
                'name'=> 'BPS Kota Kupang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '365',
                'kode_wil'=> '6101',
                'name'=> 'BPS Kabupaten Sambas',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '366',
                'kode_wil'=> '6102',
                'name'=> 'BPS Kabupaten Bengkayang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '367',
                'kode_wil'=> '6103',
                'name'=> 'BPS Kabupaten Landak',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '368',
                'kode_wil'=> '6104',
                'name'=> 'BPS Kabupaten Mempawah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '369',
                'kode_wil'=> '6105',
                'name'=> 'BPS Kabupaten Sanggau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '370',
                'kode_wil'=> '6106',
                'name'=> 'BPS Kabupaten Ketapang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '371',
                'kode_wil'=> '6107',
                'name'=> 'BPS Kabupaten Sintang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '372',
                'kode_wil'=> '6108',
                'name'=> 'BPS Kabupaten Kapuas Hulu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '373',
                'kode_wil'=> '6109',
                'name'=> 'BPS Kabupaten Sekadau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '374',
                'kode_wil'=> '6110',
                'name'=> 'BPS Kabupaten Melawi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '375',
                'kode_wil'=> '6111',
                'name'=> 'BPS Kabupaten Kayong Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '376',
                'kode_wil'=> '6112',
                'name'=> 'BPS Kabupaten Kubu Raya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '377',
                'kode_wil'=> '6171',
                'name'=> 'BPS Kota Pontianak',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '378',
                'kode_wil'=> '6172',
                'name'=> 'BPS Kota Singkawang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '379',
                'kode_wil'=> '6201',
                'name'=> 'BPS Kabupaten Kotawaringin Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '380',
                'kode_wil'=> '6202',
                'name'=> 'BPS Kabupaten Kotawaringin Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '381',
                'kode_wil'=> '6203',
                'name'=> 'BPS Kabupaten Kapuas',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '382',
                'kode_wil'=> '6204',
                'name'=> 'BPS Kabupaten Barito Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '383',
                'kode_wil'=> '6205',
                'name'=> 'BPS Kabupaten Barito Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '384',
                'kode_wil'=> '6206',
                'name'=> 'BPS Kabupaten Sukamara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '385',
                'kode_wil'=> '6207',
                'name'=> 'BPS Kabupaten Lamandau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '386',
                'kode_wil'=> '6208',
                'name'=> 'BPS Kabupaten Seruyan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '387',
                'kode_wil'=> '6209',
                'name'=> 'BPS Kabupaten Katingan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '388',
                'kode_wil'=> '6210',
                'name'=> 'BPS Kabupaten Pulang Pisau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '389',
                'kode_wil'=> '6211',
                'name'=> 'BPS Kabupaten Gunung Mas',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '390',
                'kode_wil'=> '6212',
                'name'=> 'BPS Kabupaten Barito Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '391',
                'kode_wil'=> '6213',
                'name'=> 'BPS Kabupaten Murung Raya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '392',
                'kode_wil'=> '6271',
                'name'=> 'BPS Kota Palangka Raya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '393',
                'kode_wil'=> '6301',
                'name'=> 'BPS Kabupaten Tanah Laut',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '394',
                'kode_wil'=> '6302',
                'name'=> 'BPS Kabupaten Kota Baru',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '395',
                'kode_wil'=> '6303',
                'name'=> 'BPS Kabupaten Banjar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '396',
                'kode_wil'=> '6304',
                'name'=> 'BPS Kabupaten Barito Kuala',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '397',
                'kode_wil'=> '6305',
                'name'=> 'BPS Kabupaten Tapin',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '398',
                'kode_wil'=> '6306',
                'name'=> 'BPS Kabupaten Hulu Sungai Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '399',
                'kode_wil'=> '6307',
                'name'=> 'BPS Kabupaten Hulu Sungai Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '400',
                'kode_wil'=> '6308',
                'name'=> 'BPS Kabupaten Hulu Sungai Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '401',
                'kode_wil'=> '6309',
                'name'=> 'BPS Kabupaten Tabalong',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '402',
                'kode_wil'=> '6310',
                'name'=> 'BPS Kabupaten Tanah Bumbu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '403',
                'kode_wil'=> '6311',
                'name'=> 'BPS Kabupaten Balangan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '404',
                'kode_wil'=> '6371',
                'name'=> 'BPS Kota Banjarmasin',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '405',
                'kode_wil'=> '6372',
                'name'=> 'BPS Kota Banjar Baru',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '406',
                'kode_wil'=> '6401',
                'name'=> 'BPS Kabupaten Paser',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '407',
                'kode_wil'=> '6402',
                'name'=> 'BPS Kabupaten Kutai Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '408',
                'kode_wil'=> '6403',
                'name'=> 'BPS Kabupaten Kutai Kartanegara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '409',
                'kode_wil'=> '6404',
                'name'=> 'BPS Kabupaten Kutai Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '410',
                'kode_wil'=> '6405',
                'name'=> 'BPS Kabupaten Berau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '411',
                'kode_wil'=> '6409',
                'name'=> 'BPS Kabupaten Penajam Paser Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '412',
                'kode_wil'=> '6471',
                'name'=> 'BPS Kota Balikpapan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '413',
                'kode_wil'=> '6472',
                'name'=> 'BPS Kota Samarinda',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '414',
                'kode_wil'=> '6474',
                'name'=> 'BPS Kota Bontang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '415',
                'kode_wil'=> '6501',
                'name'=> 'BPS Kabupaten Malinau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '416',
                'kode_wil'=> '6502',
                'name'=> 'BPS Kabupaten Bulungan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '417',
                'kode_wil'=> '6503',
                'name'=> 'BPS Kabupaten Tana Tidung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '418',
                'kode_wil'=> '6504',
                'name'=> 'BPS Kabupaten Nunukan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '419',
                'kode_wil'=> '6571',
                'name'=> 'BPS Kota Tarakan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '420',
                'kode_wil'=> '7101',
                'name'=> 'BPS Kabupaten Bolaang Mongondow',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '421',
                'kode_wil'=> '7102',
                'name'=> 'BPS Kabupaten Minahasa',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '422',
                'kode_wil'=> '7103',
                'name'=> 'BPS Kabupaten Kepulauan Sangihe',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '423',
                'kode_wil'=> '7104',
                'name'=> 'BPS Kabupaten Kepulauan Talaud',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '424',
                'kode_wil'=> '7105',
                'name'=> 'BPS Kabupaten Minahasa Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '425',
                'kode_wil'=> '7106',
                'name'=> 'BPS Kabupaten Minahasa Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '426',
                'kode_wil'=> '7107',
                'name'=> 'BPS Kabupaten Bolaang Mongondow Ut',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '427',
                'kode_wil'=> '7108',
                'name'=> 'BPS Kabupaten Siau Tagulandang Bia',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '428',
                'kode_wil'=> '7171',
                'name'=> 'BPS Kota Manado',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '429',
                'kode_wil'=> '7172',
                'name'=> 'BPS Kota Bitung',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '430',
                'kode_wil'=> '7173',
                'name'=> 'BPS Kota Tomohon',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '431',
                'kode_wil'=> '7174',
                'name'=> 'BPS Kota Kotamobagu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '432',
                'kode_wil'=> '7201',
                'name'=> 'BPS Kabupaten Banggai Kepulauan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '433',
                'kode_wil'=> '7202',
                'name'=> 'BPS Kabupaten Banggai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '434',
                'kode_wil'=> '7203',
                'name'=> 'BPS Kabupaten Morowali',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '435',
                'kode_wil'=> '7204',
                'name'=> 'BPS Kabupaten Poso',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '436',
                'kode_wil'=> '7205',
                'name'=> 'BPS Kabupaten Donggala',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '437',
                'kode_wil'=> '7206',
                'name'=> 'BPS Kabupaten Toli-toli',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '438',
                'kode_wil'=> '7207',
                'name'=> 'BPS Kabupaten Buol',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '439',
                'kode_wil'=> '7208',
                'name'=> 'BPS Kabupaten Parigi Moutong',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '440',
                'kode_wil'=> '7209',
                'name'=> 'BPS Kabupaten Tojo Una-Una',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '441',
                'kode_wil'=> '7210',
                'name'=> 'BPS Kabupaten Sigi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '442',
                'kode_wil'=> '7271',
                'name'=> 'BPS Kota Palu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '443',
                'kode_wil'=> '7301',
                'name'=> 'BPS Kabupaten Kepulauan Selayar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '444',
                'kode_wil'=> '7302',
                'name'=> 'BPS Kabupaten Bulukumba',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '445',
                'kode_wil'=> '7303',
                'name'=> 'BPS Kabupaten Bantaeng',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '446',
                'kode_wil'=> '7304',
                'name'=> 'BPS Kabupaten Jeneponto',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '447',
                'kode_wil'=> '7305',
                'name'=> 'BPS Kabupaten Takalar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '448',
                'kode_wil'=> '7306',
                'name'=> 'BPS Kabupaten Gowa',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '449',
                'kode_wil'=> '7307',
                'name'=> 'BPS Kabupaten Sinjai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '450',
                'kode_wil'=> '7308',
                'name'=> 'BPS Kabupaten Maros',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '451',
                'kode_wil'=> '7309',
                'name'=> 'BPS Kabupaten Pangkajene Kepulauan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '452',
                'kode_wil'=> '7310',
                'name'=> 'BPS Kabupaten Barru',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '453',
                'kode_wil'=> '7311',
                'name'=> 'BPS Kabupaten Bone',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '454',
                'kode_wil'=> '7312',
                'name'=> 'BPS Kabupaten Soppeng',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '455',
                'kode_wil'=> '7313',
                'name'=> 'BPS Kabupaten Wajo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '456',
                'kode_wil'=> '7314',
                'name'=> 'BPS Kabupaten Sidenreng Rappang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '457',
                'kode_wil'=> '7315',
                'name'=> 'BPS Kabupaten Pinrang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '458',
                'kode_wil'=> '7316',
                'name'=> 'BPS Kabupaten Enrekang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '459',
                'kode_wil'=> '7317',
                'name'=> 'BPS Kabupaten Luwu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '460',
                'kode_wil'=> '7318',
                'name'=> 'BPS Kabupaten Tana Toraja',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '461',
                'kode_wil'=> '7322',
                'name'=> 'BPS Kabupaten Luwu Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '462',
                'kode_wil'=> '7325',
                'name'=> 'BPS Kabupaten Luwu Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '463',
                'kode_wil'=> '7326',
                'name'=> 'BPS Kabupaten Toraja Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '464',
                'kode_wil'=> '7371',
                'name'=> 'BPS Kota Makassar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '465',
                'kode_wil'=> '7372',
                'name'=> 'BPS Kota Parepare',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '466',
                'kode_wil'=> '7373',
                'name'=> 'BPS Kota Palopo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '467',
                'kode_wil'=> '7401',
                'name'=> 'BPS Kabupaten Buton',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '468',
                'kode_wil'=> '7402',
                'name'=> 'BPS Kabupaten Muna',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '469',
                'kode_wil'=> '7403',
                'name'=> 'BPS Kabupaten Konawe',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '470',
                'kode_wil'=> '7404',
                'name'=> 'BPS Kabupaten Kolaka',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '471',
                'kode_wil'=> '7405',
                'name'=> 'BPS Kabupaten Konawe Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '472',
                'kode_wil'=> '7406',
                'name'=> 'BPS Kabupaten Bombana',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '473',
                'kode_wil'=> '7407',
                'name'=> 'BPS Kabupaten Wakatobi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '474',
                'kode_wil'=> '7408',
                'name'=> 'BPS Kabupaten Kolaka Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '475',
                'kode_wil'=> '7409',
                'name'=> 'BPS Kabupaten Buton Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '476',
                'kode_wil'=> '7410',
                'name'=> 'BPS Kabupaten Konawe Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '477',
                'kode_wil'=> '7411',
                'name'=> 'BPS Kabupaten Kolaka Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '478',
                'kode_wil'=> '7471',
                'name'=> 'BPS Kota Kendari',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '479',
                'kode_wil'=> '7472',
                'name'=> 'BPS Kota Baubau',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '480',
                'kode_wil'=> '7501',
                'name'=> 'BPS Kabupaten Boalemo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '481',
                'kode_wil'=> '7502',
                'name'=> 'BPS Kabupaten Gorontalo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '482',
                'kode_wil'=> '7503',
                'name'=> 'BPS Kabupaten Pohuwato',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '483',
                'kode_wil'=> '7504',
                'name'=> 'BPS Kabupaten Bone Bolango',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '484',
                'kode_wil'=> '7505',
                'name'=> 'BPS Kabupaten Gorontalo Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '485',
                'kode_wil'=> '7571',
                'name'=> 'BPS Kota Gorontalo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '486',
                'kode_wil'=> '7601',
                'name'=> 'BPS Kabupaten Majene',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '487',
                'kode_wil'=> '7602',
                'name'=> 'BPS Kabupaten Polewali Mandar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '488',
                'kode_wil'=> '7603',
                'name'=> 'BPS Kabupaten Mamasa',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '489',
                'kode_wil'=> '7604',
                'name'=> 'BPS Kabupaten Mamuju',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '490',
                'kode_wil'=> '7605',
                'name'=> 'BPS Kabupaten Pasangkayu',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '491',
                'kode_wil'=> '8101',
                'name'=> 'BPS Kabupaten Kepulauan Tanimbar',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '492',
                'kode_wil'=> '8102',
                'name'=> 'BPS Kabupaten Maluku Tenggara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '493',
                'kode_wil'=> '8103',
                'name'=> 'BPS Kabupaten Maluku Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '494',
                'kode_wil'=> '8104',
                'name'=> 'BPS Kabupaten Buru',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '495',
                'kode_wil'=> '8105',
                'name'=> 'BPS Kabupaten Kepulauan Aru',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '496',
                'kode_wil'=> '8106',
                'name'=> 'BPS Kabupaten Seram Bagian Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '497',
                'kode_wil'=> '8107',
                'name'=> 'BPS Kabupaten Seram Bagian Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '498',
                'kode_wil'=> '8108',
                'name'=> 'BPS Kabupaten Maluku Barat Daya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '499',
                'kode_wil'=> '8109',
                'name'=> 'BPS Kabupaten Buru Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '500',
                'kode_wil'=> '8171',
                'name'=> 'BPS Kota Ambon',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '501',
                'kode_wil'=> '8201',
                'name'=> 'BPS Kabupaten Halmahera Barat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '502',
                'kode_wil'=> '8202',
                'name'=> 'BPS Kabupaten Halmahera Tengah',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '503',
                'kode_wil'=> '8203',
                'name'=> 'BPS Kabupaten Kepulauan Sula',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '504',
                'kode_wil'=> '8204',
                'name'=> 'BPS Kabupaten Halmahera Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '505',
                'kode_wil'=> '8205',
                'name'=> 'BPS Kabupaten Halmahera Utara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '506',
                'kode_wil'=> '8206',
                'name'=> 'BPS Kabupaten Halmahera Timur',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '507',
                'kode_wil'=> '8207',
                'name'=> 'BPS Kabupaten Pulau Morotai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '508',
                'kode_wil'=> '8271',
                'name'=> 'BPS Kota Ternate',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '509',
                'kode_wil'=> '8272',
                'name'=> 'BPS Kota Tidore Kepulauan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '510',
                'kode_wil'=> '9101',
                'name'=> 'BPS Kabupaten Fakfak',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '511',
                'kode_wil'=> '9102',
                'name'=> 'BPS Kabupaten Kaimana',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '512',
                'kode_wil'=> '9103',
                'name'=> 'BPS Kabupaten Teluk Wondama',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '513',
                'kode_wil'=> '9104',
                'name'=> 'BPS Kabupaten Teluk Bintuni',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '514',
                'kode_wil'=> '9105',
                'name'=> 'BPS Kabupaten Manokwari',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '515',
                'kode_wil'=> '9106',
                'name'=> 'BPS Kabupaten Sorong Selatan',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '516',
                'kode_wil'=> '9107',
                'name'=> 'BPS Kabupaten Sorong',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '517',
                'kode_wil'=> '9108',
                'name'=> 'BPS Kabupaten Raja Ampat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '518',
                'kode_wil'=> '9171',
                'name'=> 'BPS Kota Sorong',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '519',
                'kode_wil'=> '9401',
                'name'=> 'BPS Kabupaten Merauke',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '520',
                'kode_wil'=> '9402',
                'name'=> 'BPS Kabupaten Jayawijaya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '521',
                'kode_wil'=> '9403',
                'name'=> 'BPS Kabupaten Jayapura',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '522',
                'kode_wil'=> '9404',
                'name'=> 'BPS Kabupaten Nabire',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '523',
                'kode_wil'=> '9408',
                'name'=> 'BPS Kabupaten Kepulauan Yapen',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '524',
                'kode_wil'=> '9409',
                'name'=> 'BPS Kabupaten Biak Numfor',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '525',
                'kode_wil'=> '9410',
                'name'=> 'BPS Kabupaten Paniai',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '526',
                'kode_wil'=> '9411',
                'name'=> 'BPS Kabupaten Puncak Jaya',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '527',
                'kode_wil'=> '9412',
                'name'=> 'BPS Kabupaten Mimika',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '528',
                'kode_wil'=> '9413',
                'name'=> 'BPS Kabupaten Boven Digoel',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '529',
                'kode_wil'=> '9414',
                'name'=> 'BPS Kabupaten Mappi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '530',
                'kode_wil'=> '9415',
                'name'=> 'BPS Kabupaten Asmat',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '531',
                'kode_wil'=> '9416',
                'name'=> 'BPS Kabupaten Yahukimo',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '532',
                'kode_wil'=> '9417',
                'name'=> 'BPS Kabupaten Pegunungan Bintang',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '533',
                'kode_wil'=> '9418',
                'name'=> 'BPS Kabupaten Tolikara',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '534',
                'kode_wil'=> '9419',
                'name'=> 'BPS Kabupaten Sarmi',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '535',
                'kode_wil'=> '9420',
                'name'=> 'BPS Kabupaten Keerom',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '536',
                'kode_wil'=> '9426',
                'name'=> 'BPS Kabupaten Waropen',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '537',
                'kode_wil'=> '9427',
                'name'=> 'BPS Kabupaten Supiori',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '538',
                'kode_wil'=> '9433',
                'name'=> 'BPS Kabupaten Puncak',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '539',
                'kode_wil'=> '9471',
                'name'=> 'BPS Kota Jayapura',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
            array (
                'id'=> '540',
                'kode_wil'=> NULL,
                'name'=> 'Pejabat Fungsional',
                'created_at'=> '2021-12-16 10:09:00',
                'updated_at'=> NULL,
                'image'=> NULL
            ),
        ));
        
        
    }
}