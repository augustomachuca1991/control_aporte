<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionJuradaLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_jurada_lines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('declaracionjurada_id')->unsigned();
            $table->foreign('declaracionjurada_id')->references('id')->on('declaracion_juradas');
            $table->string('nombre');
            $table->bigInteger('cuil')->unsigned();
            $table->date('fecha_nac');
            $table->string('sexo');
            $table->bigInteger('puesto_laboral')->unsigned();
            $table->string('cargo');
            $table->date('fecha_ingreso');
            $table->bigInteger('cod_categoria')->unsigned();
            $table->string('categoria');
            $table->bigInteger('cod_clase')->unsigned();
            $table->string('clase');
            $table->bigInteger('cod_estado')->unsigned();
            $table->string('estado');
            $table->bigInteger('cod_jurisdiccion')->unsigned();
            $table->string('jurisdiccion');
            $table->bigInteger('cod_organismo')->unsigned();
            $table->string('organismo');
            $table->decimal('haber_bruto',8,2)->unsigned();
            $table->decimal('aporte_personal',8,2)->unsigned();
            $table->decimal('aporte_estatal',8,2)->unsigned();
            $table->decimal('basico',8,2)->unsigned();
            $table->decimal('antiguedad',8,2)->unsigned()->nullable();
            $table->decimal('adicional',8,2)->unsigned()->nullable();
            $table->decimal('familiar',8,2)->unsigned()->nullable();
            $table->decimal('hijo',8,2)->unsigned()->nullable();
            $table->decimal('esposa',8,2)->unsigned()->nullable();
            $table->decimal('otro',8,2)->unsigned()->nullable();
            $table->bigInteger('cod_funcion')->unsigned()->nullable();
            $table->string('funcion')->nullable();
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
        Schema::dropIfExists('declaracion_jurada_lines');
    }
}
