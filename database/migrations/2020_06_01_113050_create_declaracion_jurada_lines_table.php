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
            $table->text('data');

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
