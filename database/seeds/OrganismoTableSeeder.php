<?php

use Illuminate\Database\Seeder;
use App\Organismo;

class OrganismoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organismos = [
			        	['cod_organismo'=> 1,  'jurisdiccion_id' => 1, 'organismo' => 'organismo 1',  'created_at' => now()],
			        	['cod_organismo'=> 2,  'jurisdiccion_id' => 1, 'organismo' => 'organismo 2',  'created_at' => now()],
			            ['cod_organismo'=> 3,  'jurisdiccion_id' => 1, 'organismo' => 'organismo 3',  'created_at' => now()],
			            ['cod_organismo'=> 4,  'jurisdiccion_id' => 2, 'organismo' => 'organismo 4',  'created_at' => now()],
			        	['cod_organismo'=> 5,  'jurisdiccion_id' => 2, 'organismo' => 'organismo 5',  'created_at' => now()],
			            ['cod_organismo'=> 6,  'jurisdiccion_id' => 3, 'organismo' => 'organismo 6',  'created_at' => now()],
			            ['cod_organismo'=> 7,  'jurisdiccion_id' => 4, 'organismo' => 'organismo 7',  'created_at' => now()],
			        	['cod_organismo'=> 8,  'jurisdiccion_id' => 5, 'organismo' => 'organismo 8',  'created_at' => now()],
			            ['cod_organismo'=> 9,  'jurisdiccion_id' => 5, 'organismo' => 'organismo 9',  'created_at' => now()],
			            ['cod_organismo'=> 10, 'jurisdiccion_id' => 5, 'organismo' => 'organismo 10', 'created_at' => now()],
			        	['cod_organismo'=> 11, 'jurisdiccion_id' => 5, 'organismo' => 'organismo 11', 'created_at' => now()],
			            ['cod_organismo'=> 12, 'jurisdiccion_id' => 6, 'organismo' => 'organismo 12', 'created_at' => now()],
			            ['cod_organismo'=> 13, 'jurisdiccion_id' => 7, 'organismo' => 'organismo 13', 'created_at' => now()],
			        	['cod_organismo'=> 14, 'jurisdiccion_id' => 8, 'organismo' => 'organismo 14', 'created_at' => now()],
			            ['cod_organismo'=> 15, 'jurisdiccion_id' => 9, 'organismo' => 'organismo 15', 'created_at' => now()],
			            ['cod_organismo'=> 16, 'jurisdiccion_id' => 10, 'organismo' => 'organismo 16', 'created_at' => now()],
			        	['cod_organismo'=> 17, 'jurisdiccion_id' => 10, 'organismo' => 'organismo 17', 'created_at' => now()],
			            ['cod_organismo'=> 18, 'jurisdiccion_id' => 10, 'organismo' => 'organismo 18', 'created_at' => now()],
			            ['cod_organismo'=> 19, 'jurisdiccion_id' => 10, 'organismo' => 'organismo 19', 'created_at' => now()],
			        	['cod_organismo'=> 20, 'jurisdiccion_id' => 20, 'organismo' => 'Empedrado',   'created_at' => now()],
			            ['cod_organismo'=> 21, 'jurisdiccion_id' => 21, 'organismo' => 'Mocoreta',    'created_at' => now()],
			            ['cod_organismo'=> 22, 'jurisdiccion_id' => 22, 'organismo' => 'Mercedes',    'created_at' => now()],
			        	['cod_organismo'=> 23, 'jurisdiccion_id' => 23, 'organismo' => 'Alvear',      'created_at' => now()],
			            ['cod_organismo'=> 24, 'jurisdiccion_id' => 24, 'organismo' => 'Saladas',     'created_at' => now()],
			            ['cod_organismo'=> 25, 'jurisdiccion_id' => 25, 'organismo' => 'Goya',        'created_at' => now()],
			        	['cod_organismo'=> 26, 'jurisdiccion_id' => 26, 'organismo' => 'Curuzu',      'created_at' => now()],
			            ['cod_organismo'=> 27, 'jurisdiccion_id' => 27, 'organismo' => 'Riachuelo',   'created_at' => now()],
			            ['cod_organismo'=> 28, 'jurisdiccion_id' => 28, 'organismo' => 'San Cosme',   'created_at' => now()],
			        	['cod_organismo'=> 29, 'jurisdiccion_id' => 29, 'organismo' => 'Bella Vista', 'created_at' => now()],
			            ['cod_organismo'=> 30, 'jurisdiccion_id' => 30, 'organismo' => 'D.P.E.C',     'created_at' => now()],

			    	];
    	Organismo::insert($organismos);
    }
}
