<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptoLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concepto_liquidacions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cod_concepto')->unsigned();
            $table->string('concepto');
            
            $table->bigInteger('organismo_id')->unsigned();
            $table->foreign('organismo_id')->references('cod_organismo')->on('organismos');
            $table->bigInteger('subtipo_id')->unsigned();
            $table->foreign('subtipo_id')->references('id')->on('subtipo_codigos');

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
        Schema::dropIfExists('concepto_liquidacions');
    }
}
