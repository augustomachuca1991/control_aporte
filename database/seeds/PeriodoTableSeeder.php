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
			        	['cod_periodo' => 202001 , 'mes' => 01, 'anio' => 2020 , 'periodo' => 'Enero de 2020','created_at' => now()],
                        ['cod_periodo' => 202002 , 'mes' => 02, 'anio' => 2020 , 'periodo' => 'Febrero de 2020','created_at' => now()],
                        ['cod_periodo' => 202003 , 'mes' => 03, 'anio' => 2020 , 'periodo' => 'Marzo de 2020','created_at' => now()],
                        ['cod_periodo' => 202004 , 'mes' => 04, 'anio' => 2020 , 'periodo' => 'Abril de 2020','created_at' => now()],
                        ['cod_periodo' => 202005 , 'mes' => 05, 'anio' => 2020 , 'periodo' => 'Mayo de 2020','created_at' => now()],
			        	['cod_periodo' => 202006 , 'mes' => 06, 'anio' => 2020 , 'periodo' => 'Junio de 2020','created_at' => now()],
                        ['cod_periodo' => 202007 , 'mes' => 07, 'anio' => 2020 , 'periodo' => 'Julio de 2020','created_at' => now()],
                        // ['cod_periodo' => 202008 , 'mes' => 08, 'anio' => 2020 , 'periodo' => 'Agosto de 2020','created_at' => now()],
                        // ['cod_periodo' => 202009 , 'mes' => 09, 'anio' => 2020 , 'periodo' => 'Septiembre de 2020','created_at' => now()],
                        // ['cod_periodo' => 202010 , 'mes' => 10, 'anio' => 2020 , 'periodo' => 'Octubre de 2020','created_at' => now()],
                        // ['cod_periodo' => 202011 , 'mes' => 11, 'anio' => 2020 , 'periodo' => 'Noviembre de 2020','created_at' => now()],
                        // ['cod_periodo' => 202012 , 'mes' => 12, 'anio' => 2020 , 'periodo' => 'Diciembre de 2020','created_at' => now()],
			    	];
    	Periodo::insert($periodos);
    }
}
		            
