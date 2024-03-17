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
        Schema::table('assets', function (Blueprint $table) {
			$table->string('bmn', 50)->nullable();
			$table->text('_snipeit_software_office_2')->nullable();
			$table->text('_snipeit_sistem_operasi_3')->nullable();
			$table->text('_snipeit_antivirus_4')->nullable();
        });
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
            $table->dropColumn('_snipeit_software_office_2');
            $table->dropColumn('_snipeit_sistem_operasi_3');
            $table->dropColumn('_snipeit_antivirus_4');
        });
    }
}
