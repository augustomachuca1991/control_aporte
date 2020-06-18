<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurisdiccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurisdiccions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cod_jurisdiccion')->unsigned()->unique();
            $table->bigInteger('origen_id')->unsigned();
            $table->foreign('origen_id')->references('cod_origen')->on('origens');
            $table->string('jurisdiccion');

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
        Schema::dropIfExists('jurisdiccions');
    }
}
