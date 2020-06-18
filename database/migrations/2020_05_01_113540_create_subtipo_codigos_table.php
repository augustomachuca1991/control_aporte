<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtipoCodigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtipo_codigos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->nullable();
            $table->bigInteger('tipocodigo_id')->unsigned();
            $table->foreign('tipocodigo_id')->references('id')->on('tipo_codigos');

            $table->softDeletes(); 
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
        Schema::dropIfExists('subtipo_codigos');
    }
}
