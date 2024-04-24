<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMulaiberlakuToLicenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('licenses', 'mulaiberlaku')) {
            Schema::table('licenses', function (Blueprint $table) {
                $table->date('mulaiberlaku')->nullable()->change();
            });
        } else {
            Schema::table('licenses', function (Blueprint $table) {
                $table->date('mulaiberlaku')->nullable();
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
        Schema::table('licenses', function (Blueprint $table) {
            $table->dropColumn('mulaiberlaku');
        });
    }
}
