<?php

return array(

    'deleted' => 'Deleted asset model',
    'does_not_exist' => 'Model tidak ada.',
    'no_association' => 'WARNING! The asset model for this item is invalid or missing!',
    'no_association_fix' => 'Ini akan merusak banyak hal dengan cara yang aneh dan mengerikan. Edit aset ini sekarang untuk menetapkannya sebagai model.',
    'assoc_users'	 => 'Saat ini model/tipe tersebut terhubung dengan 1 atau lebih dengan aset dan tidak dapat di hapus. Silahkan hapus aset terlebih dahulu, kemudian coba hapus kembali. ',


    'create' => array(
        'error'   => 'Model/Tipe gagal di buat, silahkan coba kembali.',
        'success' => 'Sukses mebuat model/tipe.',
        'duplicate_set' => 'Model/Tipe aset dengan nomor nama, produsen dan model/tipe yang sama sudah ada.',
    ),

    'update' => array(
        'error'   => 'Model/Tipe gagal diperbarui, silahkan coba kembali',
        'success' => 'Sukses memperbarui Model/Tipe.'
    ),

    'delete' => array(
        'confirm'   => 'Anda yakin untuk menghapus model/tipe aset ini?',
        'error'   => 'Terdapat kesalahan pada saat penghapusan model/tipe. Silahkan coba kembali.',
        'success' => 'Model/Tipe sukses terhapus.'
    ),

    'restore' => array(
        'error'   		=> 'Modal gagal di pulihkan, silahkan coba kembali',
        'success' 		=> 'Sukses memulihkan model/tipe.'
    ),

    'bulkedit' => array(
        'error'   		=> 'Tidak ada bidang yang berubah, jadi tidak ada yang diperbarui.',
        'success' 		=> 'Model/Tipe diperbarui',
        'warn'          => 'Anda akan memperbarui properti dari model berikut: |Anda akan mengedit properti dari :model_count model berikut:',

    ),

    'bulkdelete' => array(
        'error'   		    => 'Tidak ada model/tipe yang dipilih, jadi tidak ada yang dihapus.',
        'success' 		    => ':success_count model/tipe dihapus!',
        'success_partial' 	=> ':success_count model/tipe telah dihapus, tetapi :fail_count tidak dapat dihapus karena masih memiliki aset yang terkait dengannya.'
    ),

);
