<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_group_id');
            $table->string('product_specific_table');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('product_specific_id');
            $table->boolean('visible')->default(1);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('t_products');
    }
}
