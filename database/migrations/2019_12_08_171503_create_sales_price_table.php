<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->float('sales_price');
            $table->float('number_days');
            $table->float('probability')->nullable();
            $table->float('accumulate_probability')->nullable();
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
        Schema::dropIfExists('sales_price');
    }
}
