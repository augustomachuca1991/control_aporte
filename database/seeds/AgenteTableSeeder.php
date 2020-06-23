<?php

use Illuminate\Database\Seeder;
use App\Agente;

class AgenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Agente::class , 1000)->create()
        ->each(function (App\Agente  $agente){
            $agente->organismos()->attach( rand(1,19) , ['cod_laboral' => rand(500, 10000)]);
        });
    }
}
