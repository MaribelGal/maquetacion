<!-----------------------------------------------------------------------------
   14.04.2021 - Examen -->
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nif');
            $table->string('nombre');
            $table->integer('telefono');
            $table->string('correo');
            $table->string('direccion'); //Contendrá: calle, número, piso, puerta
            $table->integer('cp');
            $table->string('poblacion');
            $table->string('provincia');
            $table->string('pais');
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
        Schema::dropIfExists('t_clientes');
    }
}

//-----------------------------------------------------------------------------