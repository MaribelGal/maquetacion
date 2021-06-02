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
            $table->string('name');
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
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
        Schema::dropIfExists('t_shirts');
    }
}
