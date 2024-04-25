<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('locations', 'company_id')) {
            Schema::table('locations', function (Blueprint $table) {
                $table->integer('company_id')->unsigned()->nullable()->change();
                $table->index(['company_id']);
            });
        } else {
            Schema::table('locations', function (Blueprint $table) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->index(['company_id']);
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
        Schema::table('locations', function (Blueprint $table) {
            $table->dropIndex(['company_id']);
            $table->dropColumn('company_id');
        });
    }
}