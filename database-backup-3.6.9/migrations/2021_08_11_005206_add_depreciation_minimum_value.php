<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepreciationMinimumValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('depreciations', 'user_id')) {
            Schema::table('depreciations', function (Blueprint $table) {
                $table->integer('user_id')->nullable()->default(null)->change();
            });
        } else {
            Schema::table('depreciations', function (Blueprint $table) {
                $table->integer('user_id')->nullable()->default(null);
            });
        }

        if (Schema::hasColumn('depreciations', 'depreciation_min')) {
            Schema::table('depreciations', function (Blueprint $table) {
                $table->decimal('depreciation_min', 8, 2)->after('months')->nullable()->default(null)->change();
            });
        } else {
            Schema::table('depreciations', function (Blueprint $table) {
                $table->decimal('depreciation_min', 8, 2)->after('months')->nullable()->default(null);
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
        Schema::table('depreciations', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('depreciation_min');
        });
    }
}
