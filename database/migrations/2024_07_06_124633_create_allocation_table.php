<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->nullable()->default(null);
            $table->integer('user_id')->nullable()->default(null);
            $table->string('asssigned_type')->nullable()->default(null);
            $table->integer('assets_id')->nullable()->default(null);
            $table->integer('category_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('bmn')->nullable()->default(null);
            $table->string('serial')->nullable()->default(null);
            $table->string('kondisi')->nullable()->default(null);
            $table->string('os')->nullable()->default(null);
            $table->string('office')->nullable()->default(null);
            $table->string('antivirus')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->date('request_date')->nullable()->default(null);
            $table->date('handling_date')->nullable()->default(null);
            $table->date('deleted_at')->nullable()->default(null);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocation');
    }
}
