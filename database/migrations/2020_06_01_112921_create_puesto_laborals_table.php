<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestoLaboralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puesto_laborals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cod_laboral')->unsigned();
            $table->bigInteger('organismo_id')->unsigned();
            $table->foreign('organismo_id')->references('cod_organismo')->on('organismos');
            //$table->bigInteger('estado_id')->unsigned();
            //$table->foreign('estado_id')->references('id')->on('estados');
            $table->bigInteger('agente_id')->unsigned();
            $table->foreign('agente_id')->references('id')->on('agentes');

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
        Schema::dropIfExists('puesto_laborals');
    }
}
