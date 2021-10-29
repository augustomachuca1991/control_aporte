<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dpto_id')->unsigned();
            $table->foreign('dpto_id')->references('id')->on('dptos');
            $table->bigInteger('subtipo_id')->unsigned();
            $table->foreign('subtipo_id')->references('id')->on('subtipo_codigos');
            $table->bigInteger('tipocodigo_id')->unsigned();
            $table->foreign('tipocodigo_id')->references('id')->on('tipo_codigos');

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
        Schema::dropIfExists('configuracions');
    }
}
