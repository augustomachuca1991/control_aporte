<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_liquidacions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->bigInteger('funcion_id')->unsigned()->nullable();
            $table->foreign('funcion_id')->references('id')->on('funcions');
            $table->bigInteger('h_laboral_id')->unsigned()->nullable();
            $table->foreign('h_laboral_id')->references('id')->on('historia_laborals');
            $table->bigInteger('liquidacion_id')->unsigned();
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');

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
        Schema::dropIfExists('historia_liquidacions');
    }
}
