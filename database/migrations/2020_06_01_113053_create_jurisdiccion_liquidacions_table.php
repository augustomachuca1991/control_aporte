<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurisdiccionLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurisdiccion_liquidacions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jurisdiccion_id')->unsigned();
            $table->foreign('jurisdiccion_id')->references('cod_jurisdiccion')->on('jurisdiccions');
            $table->bigInteger('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipo_liquidacions');
            $table->bigInteger('periodo_id')->unsigned();
            $table->foreign('periodo_id')->references('cod_periodo')->on('periodos');
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
        Schema::dropIfExists('jurisdiccion_liquidacions');
    }
}
