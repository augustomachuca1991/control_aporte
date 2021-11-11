<?php

use App\Funcion;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\FuncCall;

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
