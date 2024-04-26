<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTiketToAssetMaintenances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('asset_maintenances', 'tiket')) {
            Schema::table('asset_maintenances', function (Blueprint $table) {
                $table->string('tiket', 150)->nullable()->change();
            });
        } else {
            Schema::table('asset_maintenances', function (Blueprint $table) {
                $table->string('tiket', 150)->nullable();
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
            $table->dropColumn('tiket');
        });
    }
}
