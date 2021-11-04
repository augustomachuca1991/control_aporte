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
            $table->bigInteger('concepto_id')->unsigned();
            $table->foreign('concepto_id')->references('id')->on('concepto_liquidacions');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('subtipo_id')->unsigned();
            $table->bigInteger('tipocodigo_id')->unsigned();

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
