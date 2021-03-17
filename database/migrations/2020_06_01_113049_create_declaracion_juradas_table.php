<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionJuradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_juradas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('periodo_id')->unsigned();
            $table->foreign('periodo_id')->references('cod_periodo')->on('periodos');
            $table->bigInteger('tipoliquidacion_id')->unsigned();
            $table->foreign('tipoliquidacion_id')->references('id')->on('tipo_liquidacions');
            $table->bigInteger('organismo_id')->unsigned();
            $table->foreign('organismo_id')->references('cod_organismo')->on('organismos');
            $table->string('path');
            $table->string('nombre_archivo');
            $table->unsignedInteger('secuencia')->nullable();

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
        Schema::dropIfExists('declaracion_juradas');
    }
}
