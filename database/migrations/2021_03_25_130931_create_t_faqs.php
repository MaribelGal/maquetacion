<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTFaqs extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('description');
            $table->boolean('active')->default(1);
            $table->boolean('visible');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('t_faq_categories')->onUpdate('cascade');
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
        Schema::dropIfExists('t_faqs');
    }
}
