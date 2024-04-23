<?php

return [

    'does_not_exist' => 'Label status tidak ada.',
    'assoc_assets'	 => 'Saat ini label status tersebut terhubung dengan 1 aset dan tidak dapat di hapus. Silahkan perbarui aset anda sehingga tidak terhubung dan kemudian coba kembali. ',

    'create' => [
        'error'   => 'Status Aset gagal dibuat, silahkan coba lagi.',
        'success' => 'Sukses membuat status aset.',
    ],

    'update' => [
        'error'   => 'Gagal perbarui status aset, silahkan coba kembali',
        'success' => 'Sukses perbarui status aset.',
    ],

    'delete' => [
        'confirm'   => 'Anda yakin untuk menghapus status aset ini?',
        'error'   => 'Terdapat kesalahan pada saat penghapusan status aset ini. Silahkan coba kembali.',
        'success' => 'Sukses menghapus status aset.',
    ],

    'help' => [
        'undeployable'   => 'Aset ini tidak dapat diberikan/dialokasikan kepada siapapun.',
        'deployable'   => 'Aset ini dapat dialokasikan. Setelah perangkat dialokasikan, status perangkat akan berubah menjadi <i class="fas fa-circle text-blue"></i> <strong>Telah dialokasikan</strong>.',
        'archived'   => 'Aset ini tidak dapat dialokasikan, dan hanya akan muncul di tampilan Arsip. Status ini berguna untuk menyimpan informasi tentang perangkat untuk tujuan anggaran/history namun memisahkan mereka dari daftar perangkat lainnya.',
        'pending'   => 'Aset ini belum bisa diberikan/dialokasikan kepada siapapun, status ini digunakan untuk barang yang sedang diperbaiki.',
    ],

];
