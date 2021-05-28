<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTShirtsTissues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_shirts_tissues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tissue');
            $table->unsignedBigInteger('id_shirt');
            $table->integer('percentage_tissue');
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
        Schema::dropIfExists('t_shirts_tissues');
    }
}
