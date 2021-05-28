<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProductsPricesPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_products_prices_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->decimal('price',9,2);
            $table->decimal('total_taxes_sum',3,2);
            $table->decimal('total_discounts_sum',3,2);
            $table->decimal('total_price',9,2);
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
        Schema::dropIfExists('t_products_prices_purchases');
    }
}
