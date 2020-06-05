<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionOrganismosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacion_organismos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organismo_id')->unsigned();
            $table->foreign('organismo_id')->references('cod_organismo')->on('organismos');
            $table->bigInteger('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipo_liquidacions');
            $table->bigInteger('periodo_id')->unsigned();
            $table->foreign('periodo_id')->references('cod_periodo')->on('periodos');
            $table->bigInteger('liquidacion_id')->unsigned();
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');
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
        Schema::dropIfExists('liquidacion_organismos');
    }
}
