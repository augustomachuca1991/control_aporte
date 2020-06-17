<?php

use Illuminate\Database\Seeder;
use App\SubtipoCodigo;


class SubtipoCodigoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subtipo = [
			        	['descripcion' => 'Sueldo Basico' ,      'tipocodigo_id' => 1 , 'created_at' => now()],
			        	['descripcion' => 'Antiguedad' ,         'tipocodigo_id' => 1 , 'created_at' => now()],
			        	['descripcion' => 'Adicional' ,          'tipocodigo_id' => 2 , 'created_at' => now()],
			        	['descripcion' => 'Adicional' ,          'tipocodigo_id' => 3 , 'created_at' => now()],
			        	['descripcion' => 'Adicional' ,          'tipocodigo_id' => 4 , 'created_at' => now()],
			        	['descripcion' => 'Salario Familiar' , 	 'tipocodigo_id' => 5 , 'created_at' => now()],
			        	['descripcion' => 'Hijo' ,               'tipocodigo_id' => 5 , 'created_at' => now()],
			        	['descripcion' => 'Esposa' ,             'tipocodigo_id' => 5 , 'created_at' => now()],
			        	['descripcion' => 'Aporte Jubilatorio' , 'tipocodigo_id' => 6 , 'created_at' => now()],
			        	['descripcion' => 'Sobre Remunerativo' , 'tipocodigo_id' => 6 , 'created_at' => now()],
			        	['descripcion' => 'Otros' , 			 'tipocodigo_id' => 6 , 'created_at' => now()],
			    	];
    	SubtipoCodigo::insert($subtipo);
    }
}
