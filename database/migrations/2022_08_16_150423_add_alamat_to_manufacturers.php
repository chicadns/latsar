<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlamatToManufacturers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $columns = array('alamat' => 200, 'fax_perus' => 35);
        foreach($columns as $key => $value){
            if (Schema::hasColumn('manufacturers', $key)) {
                Schema::table('manufacturers', function (Blueprint $table) use ($key, $value) {
                    $table->string($key, $value)->nullable()->change();
                });
            } else {
                Schema::table('manufacturers', function (Blueprint $table) use ($key, $value) {
                    $table->string($key, $value)->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->dropColumn('fax_perus');
        });
    }
}
