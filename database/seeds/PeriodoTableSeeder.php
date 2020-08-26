<?php

use Illuminate\Database\Seeder;
use App\Periodo;

class PeriodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodos = [
			        	['cod_periodo' => 202005 , 'mes' => 05, 'anio' => 2020 , 'periodo' => 'Mayo de 2020','created_at' => now()],
			        	['cod_periodo' => 202006 , 'mes' => 06, 'anio' => 2020 , 'periodo' => 'Junio de 2020','created_at' => now()],
			    	];
    	Periodo::insert($periodos);
    }
}
		            
