<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTiketHalosisToAssetMaintenances extends Migration
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
                $table->string('tiket', 150)->default(null)->change();
            });
        } else {
            Schema::table('asset_maintenances', function (Blueprint $table) {
                $table->string('tiket', 150)->default(null);
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
