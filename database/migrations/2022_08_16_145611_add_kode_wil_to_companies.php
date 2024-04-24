<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeWilToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('companies', 'kode_wil')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->integer('kode_wil')->nullable()->change();
            });
        } else {
            Schema::table('companies', function (Blueprint $table) {
                $table->integer('kode_wil')->nullable();
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
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('kode_wil');
        });
    }
}
