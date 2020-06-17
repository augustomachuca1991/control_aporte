<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacion_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('liquidacion_id')->unsigned();
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');
            $table->bigInteger('concepto_id')->unsigned();
            $table->foreign('concepto_id')->references('id')->on('concepto_liquidacions');
            $table->string('unidad')->nullable();
            $table->decimal('importe',8,2)->unsigned();
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
        Schema::dropIfExists('liquidacion_detalles');
    }
}
