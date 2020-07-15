<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaLaboralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historia_laborals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('puesto_id')->unsigned();
            $table->foreign('puesto_id')->references('id')->on('agente_organismo');
            $table->bigInteger('clase_id')->unsigned();
            $table->foreign('clase_id')->references('id')->on('clases');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
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
        Schema::dropIfExists('historia_laborals');
    }
}
