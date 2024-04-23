<?php

return [
    'about_assets_title'           => 'Tentang Aset',
    'about_assets_text'            => 'Aset adalah barang yang dilacak dengan nomor seri atau tanda aset. Cenderung menjadi barang dengan nilai lebih tinggi dimana identifikasi barang secara spesifik berpengaruh.',
    'archived'  				=> 'Diarsipkan',
    'asset'  					=> 'Aset',
    'bulk_checkout'             => 'Alokasi',
    'bulk_checkin'              => 'Bulk Realokasi Aset',
    'checkin'  					=> 'Realokasi Aset',
    'checkout'  				=> 'Alokasi Aset',
    'clone'  					=> 'Klon Aset',
    'deployable'  				=> 'Dapat digunakan',
    'deleted'  					=> 'Aset ini telah dihapus.',
    'delete_confirm'            => 'Are you sure you want to delete this asset?',
    'edit'  					=> 'Sunting Aset',
    'model_deleted'  			=> 'Model/Tipe Aset ini telah dihapus. Anda harus memulihkan model/tipe aset tersebut sebelum Anda dapat memulihkan Aset.',
    'model_invalid'             => 'The Model of this Asset is invalid.',
    'model_invalid_fix'         => 'The Asset should be edited to correct this before attempting to check it in or out.',
    'requestable'               => 'Aset yang Dapat diminta',
    'requested'				    => 'Telah diminta',
    'not_requestable'           => 'Tidak Dapat Diminta',
    'requestable_status_warning' => 'Jangan mengubah status yang dapat diminta',
    'restore'  					=> 'Mengembalikan aset',
    'pending'  					=> 'Dalam Pemeliharaan/Ditunda',
    'undeployable'  			=> 'Tidak dapat dialokasikan',
    'undeployable_tooltip'  	=> 'This asset has a status label that is undeployable and cannot be checked out at this time.',
    'view'  					=> 'Tampilkan aset',
    'csv_error' => 'Anda memiliki eror pada file CSV Anda:',
    'import_text' => '
    <p>
    Unggah CSV yang memiliki riwayat aset. Aset dan penggunanya WAJIB sudah ada di sistem terlebih dahulu, atau nanti akan dilewati. Matching aset-aset untuk impor riwayat terjadi berdasarkan tag aset. Kami akan mencoba mencari pengguna yang match berdasarkan nama pengguna yang Anda berikan, dan kriteria yang Anda pilih di bawah. Jika Anda tidak memilih kriteria apapun yang ada di bawah, maka yang terjadi adalah sistem mencoba match berdasarkan format yang Anda konfigurasikan melalui Admin &gt; Pengaturan Umum.
    </p>

    <p>Fields included in the CSV must match the headers: <strong>Asset Tag, Name, Checkout Date, Checkin Date</strong>. Any additional fields will be ignored. </p>

    <p>Mengecek Tanggal: kosong atau realokasi bertanggal maju akan mengalokasikan item ke pengguna yang terasosiasi.  Mengecualikan kolom Tanggal Realokasi akan membuat tanggal realokasi dengan tanggal hari ini.</p>
    ',
    'csv_import_match_f-l' => 'Cobalah match pengguna berdasarkan format firstname.lastname (jane.smith)',
    'csv_import_match_initial_last' => 'Cobalah match pengguna berdasarkan first initial last name (jsmith)',
    'csv_import_match_first' => 'Cobalah match pengguna berdasarkan first name (jane) format',
    'csv_import_match_email' => 'Cobalah match pengguna berdasarkan email sebagai username',
    'csv_import_match_username' => 'Cobalah match pengguna berdasarkan username',
    'error_messages' => 'Pesan kesalahan:',
    'success_messages' => 'Pesan berhasil:',
    'alert_details' => 'Mohon agar lihat detail di bawah.',
    'custom_export' => 'Ekspor Custom',
    'mfg_warranty_lookup' => ':manufacturer Warranty Status Lookup',
    'user_department' => 'User Department',
];
