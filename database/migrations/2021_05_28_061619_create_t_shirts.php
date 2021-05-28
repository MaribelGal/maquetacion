<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTShirts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_shirts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_shirt_type');
            $table->unsignedBigInteger('id_shirt_size');
            $table->unsignedBigInteger('id_shirt_sleeve');
            $table->unsignedBigInteger('id_shirt_neck');
            $table->unsignedBigInteger('id_shirt_pattern');
            $table->unsignedBigInteger('id_color');
            $table->unsignedBigInteger('id_brand');
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
        Schema::dropIfExists('t_shirts');
    }
}
