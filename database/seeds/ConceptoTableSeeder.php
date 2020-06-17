<?php

use Illuminate\Database\Seeder;
use App\ConceptoLiquidacion;

class ConceptoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conceptos = [
			        	['concepto' => 'basico' , 					'organismo_id' => 29, 'subtipo_id' => 1, 'created_at' => now()],
			        	['concepto' => 'antiguedad' , 				'organismo_id' => 29, 'subtipo_id' => 2, 'created_at' => now()],
			        	['concepto' => 'presentismo' , 				'organismo_id' => 29, 'subtipo_id' => 3, 'created_at' => now()],
			        	['concepto' => 'bonificacion por titutlo' , 'organismo_id' => 29, 'subtipo_id' => 4, 'created_at' => now()],
			        	['concepto' => 'esposa' , 					'organismo_id' => 29, 'subtipo_id' => 8, 'created_at' => now()],
			        	['concepto' => 'jubilacion' , 				'organismo_id' => 29, 'subtipo_id' => 9, 'created_at' => now()],
			        	['concepto' => 'obra social' , 			    'organismo_id' => 29, 'subtipo_id' => 11, 'created_at' => now()],
			        	['concepto' => 'seguro de vida' , 			'organismo_id' => 29, 'subtipo_id' => 11, 'created_at' => now()],
			        	['concepto' => 'resolucion nº 552/2009' , 	'organismo_id' => 29, 'subtipo_id' => 5, 'created_at' => now()],
			    	];
    	ConceptoLiquidacion::insert($conceptos);
    }
}
