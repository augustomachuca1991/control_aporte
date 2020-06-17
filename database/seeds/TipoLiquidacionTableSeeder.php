<?php

use Illuminate\Database\Seeder;
use App\TipoLiquidacion;

class TipoLiquidacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo = [
        	['descripcion' => 'Sueldo', 'created_at' => now() ],
        	['descripcion' => 'SAC', 'created_at' => now()],
        ];
    	TipoLiquidacion::insert($tipo);
    }
}
