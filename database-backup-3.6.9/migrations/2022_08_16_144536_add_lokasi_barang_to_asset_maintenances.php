<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLokasiBarangToAssetMaintenances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('asset_maintenances', 'lokasi_barang')) {
            Schema::table('asset_maintenances', function (Blueprint $table) {
                $table->string('lokasi_barang', 150)->change();
            });
        } else {
            Schema::table('asset_maintenances', function (Blueprint $table) {
                $table->string('lokasi_barang', 150);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_maintenances', function (Blueprint $table) {
            $table->dropColumn('lokasi_barang');
        });
    }
}
