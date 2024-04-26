<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumablesDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumables_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transaction_id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('consumable_id');
            $table->unsignedInteger('category_id');
            $table->decimal('purchase_cost', 13, 4)->nullable();
            $table->integer('qty')->default(0);
            $table->integer('approve_qty')->nullable();
            $table->foreign('transaction_id')->references('id')->on('consumables_transaction');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('consumable_id')->references('id')->on('consumables');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumables_details');
    }
}
