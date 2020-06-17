<?php

use Illuminate\Database\Seeder;
use App\Origen;

class OrigenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $origenes = [
			        	['cod_origen'=> 1, 'origen' => 'Sisper', 'created_at' => now() ],
			        	['cod_origen'=> 2, 'origen' => 'Municipio', 'created_at' => now()],
			            ['cod_origen'=> 3, 'origen' => 'Entidad Autonoma', 'created_at' => now()],
			    	];
    	Origen::insert($origenes);
    }
}
