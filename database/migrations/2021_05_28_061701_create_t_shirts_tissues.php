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
            $table->unsignedBigInteger('tissue_id');
            $table->unsignedBigInteger('product_id'); //shirt  model
            $table->integer('percentage_tissue');
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
        Schema::dropIfExists('t_shirts_tissues');
    }
}
