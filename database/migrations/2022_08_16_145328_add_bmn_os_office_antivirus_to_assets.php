<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBmnOsOfficeAntivirusToAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columns = array('_snipeit_software_office_1', '_snipeit_sistem_operasi_2', '_snipeit_antivirus_3');
        foreach ($columns as $column) {
            if (Schema::hasColumn('assets', $column)) {
                Schema::table('assets', function (Blueprint $table) use ($column) {
                    $table->text($column)->nullable()->change();
                });
            } else {
                Schema::table('assets', function (Blueprint $table) use ($column) {
                    $table->text($column)->nullable();
                });
            }
        }


        if (Schema::hasColumn('assets', 'bmn')) {
            Schema::table('assets', function (Blueprint $table) {
                $table->string('bmn', 50)->nullable()->change();
            });
        } else {
            Schema::table('assets', function (Blueprint $table) {
                $table->string('bmn', 50)->nullable();
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
            $table->dropColumn('bmn');
            $table->dropColumn('_snipeit_software_office_1');
            $table->dropColumn('_snipeit_sistem_operasi_2');
            $table->dropColumn('_snipeit_antivirus_3');
        });
    }
}
