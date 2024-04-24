<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBastToAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('assets', '_snipeit_bast_4')) {
            Schema::table('assets', function (Blueprint $table) {
                $table->text('_snipeit_bast_4')->nullable()->change();
            });
        } else {
            Schema::table('assets', function (Blueprint $table) {
                $table->text('_snipeit_bast_4')->nullable();
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
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('_snipeit_bast_4');
        });
    }
}
