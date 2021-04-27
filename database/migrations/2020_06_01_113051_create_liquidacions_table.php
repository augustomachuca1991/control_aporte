<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('declaracion_id')->unsigned();
            $table->foreign('declaracion_id')->references('id')->on('declaracion_juradas');
            $table->decimal('bruto',8,2)->unsigned()->nullable();
            $table->decimal('basico',8,2)->unsigned()->nullable();
            $table->decimal('aporte_personal',8,2)->unsigned()->nullable();
            $table->decimal('haberes_con_aporte',8,2)->unsigned()->nullable();
            $table->decimal('remunerativo',8,2)->unsigned()->nullable();
            $table->decimal('bonificable',8,2)->unsigned()->nullable();
            $table->decimal('no_bonificable',8,2)->unsigned()->nullable();
            $table->decimal('no_remunerativo',8,2)->unsigned()->nullable();
            $table->decimal('adicionales',8,2)->unsigned()->nullable();
            $table->decimal('familiar',8,2)->unsigned()->nullable();
            $table->decimal('hijo',8,2)->unsigned()->nullable();
            $table->decimal('esposa',8,2)->unsigned()->nullable();
            $table->decimal('descuento',8,2)->unsigned()->nullable();
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
        Schema::dropIfExists('liquidacions');
    }
}
