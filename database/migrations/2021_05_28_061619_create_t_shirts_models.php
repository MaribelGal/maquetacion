<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTShirtsModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_shirts_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('shirt_sleeve_id');
            $table->unsignedBigInteger('shirt_neck_id');
            $table->unsignedBigInteger('shirt_pattern_id');
            $table->unsignedBigInteger('brand_id');
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
        Schema::dropIfExists('t_shirts_models');
    }
}
