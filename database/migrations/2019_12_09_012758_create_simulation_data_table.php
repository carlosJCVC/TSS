<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulation_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->float('demand');
            $table->float('sale_price');
            $table->float('purchase_price');
            $table->float('purchase_cost');
            $table->float('excess_cost')->nullable();
            $table->float('benefits')->nullable();

            $table->float('excess_cost_18');
            $table->float('benefits_18');
            $table->float('excess_cost_19');
            $table->float('benefits_19');
            $table->float('excess_cost_20');
            $table->float('benefits_20');
            $table->float('excess_cost_21');
            $table->float('benefits_21');
            $table->float('excess_cost_22');
            $table->float('benefits_22');
            $table->float('excess_cost_23');
            $table->float('benefits_23');
            $table->float('excess_cost_24');
            $table->float('benefits_24');
            $table->float('excess_cost_25');
            $table->float('benefits_25');
            $table->float('excess_cost_26');
            $table->float('benefits_26');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simulation_data');
    }
}
