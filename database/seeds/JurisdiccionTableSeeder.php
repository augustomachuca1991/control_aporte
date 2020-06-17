<?php

use Illuminate\Database\Seeder;
use App\Jurisdiccion;

class JurisdiccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurisdicciones = [
			        	['cod_jurisdiccion'=> 1,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 1',               'created_at' => now()],
			        	['cod_jurisdiccion'=> 2,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 2',               'created_at' => now()],
			            ['cod_jurisdiccion'=> 3,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 3',               'created_at' => now()],
			            ['cod_jurisdiccion'=> 4,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 4',               'created_at' => now()],
			        	['cod_jurisdiccion'=> 5,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 5',               'created_at' => now()],
			            ['cod_jurisdiccion'=> 6,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 6',               'created_at' => now()],
			            ['cod_jurisdiccion'=> 7,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 7',               'created_at' => now()],
			        	['cod_jurisdiccion'=> 8,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 8',               'created_at' => now()],
			            ['cod_jurisdiccion'=> 9,  'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 9',               'created_at' => now()],
			            ['cod_jurisdiccion'=> 10, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 10',              'created_at' => now()],
			        	['cod_jurisdiccion'=> 11, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 11',              'created_at' => now()],
			            ['cod_jurisdiccion'=> 12, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 12',              'created_at' => now()],
			            ['cod_jurisdiccion'=> 13, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 13',              'created_at' => now()],
			        	['cod_jurisdiccion'=> 14, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 14',              'created_at' => now()],
			            ['cod_jurisdiccion'=> 15, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 15',              'created_at' => now()],
			            ['cod_jurisdiccion'=> 16, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 16',              'created_at' => now()],
			        	['cod_jurisdiccion'=> 17, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 17',              'created_at' => now()],
			            ['cod_jurisdiccion'=> 18, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 18',              'created_at' => now()],
			            ['cod_jurisdiccion'=> 19, 'origen_id' => 1, 'jurisdiccion' => 'jurisdiccion 19',              'created_at' => now()],
			        	['cod_jurisdiccion'=> 20, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Empedrado',   'created_at' => now()],
			            ['cod_jurisdiccion'=> 21, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Mocoreta',    'created_at' => now()],
			            ['cod_jurisdiccion'=> 22, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Mercedes',    'created_at' => now()],
			        	['cod_jurisdiccion'=> 23, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Alvear',      'created_at' => now()],
			            ['cod_jurisdiccion'=> 24, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Saladas',     'created_at' => now()],
			            ['cod_jurisdiccion'=> 25, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Goya',        'created_at' => now()],
			        	['cod_jurisdiccion'=> 26, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Curuzu',      'created_at' => now()],
			            ['cod_jurisdiccion'=> 27, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Riachuelo',   'created_at' => now()],
			            ['cod_jurisdiccion'=> 28, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de San Cosme',   'created_at' => now()],
			        	['cod_jurisdiccion'=> 29, 'origen_id' => 2, 'jurisdiccion' => 'Municipalidad de Bella Vista', 'created_at' => now()],
			            ['cod_jurisdiccion'=> 30, 'origen_id' => 3, 'jurisdiccion' => 'D.P.E.C',                      'created_at' => now()],

			    	];
    	Jurisdiccion::insert($jurisdicciones);
    }
}
