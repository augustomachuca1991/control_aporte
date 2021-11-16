<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionOrganismoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacion_organismo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organismo_id')->unsigned();
            $table->foreign('organismo_id')->references('cod_organismo')->on('organismos');
            $table->bigInteger('liquidacion_id')->unsigned();
            $table->foreign('liquidacion_id')->references('id')->on('liquidacions');
            $table->bigInteger('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipo_liquidacions');
            $table->bigInteger('periodo_id')->unsigned();
            $table->foreign('periodo_id')->references('cod_periodo')->on('periodos');
            //computo
            // $table->decimal('haber_bruto',8,2)->unsigned()->nullable();
            // $table->decimal('total_aporte_personal',8,2)->unsigned()->nullable();
            // $table->decimal('total_sueldo_basico',8,2)->unsigned()->nullable();
            // $table->decimal('total_antiguedad',8,2)->unsigned()->nullable();
            // $table->decimal('total_adicional',8,2)->unsigned()->nullable();
            // $table->decimal('total_familiar',8,2)->unsigned()->nullable();
            // $table->decimal('total_hijo',8,2)->unsigned()->nullable();
            // $table->decimal('total_esposa',8,2)->unsigned()->nullable();
            //computo
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
        Schema::dropIfExists('liquidacion_organismo');
    }
}
