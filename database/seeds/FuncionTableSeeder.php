<?php

use App\Funcion;
use Illuminate\Database\Seeder;

class FuncionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcion::create([
            'organismo_id' => 1,
            'funcion' => 'jefe de departamento'
        ]);
    }
}
