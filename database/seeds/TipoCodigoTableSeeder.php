<?php

use Illuminate\Database\Seeder;
use App\TipoCodigo;

class TipoCodigoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipocodigo = [
			        	['descripcion' => 'Remunerativo' , 'created_at' => now()],
			        	['descripcion' => 'Remunerativo Bonificable' , 'created_at' => now()],
			        	['descripcion' => 'Remunerativo No Bonificable' , 'created_at' => now()],
			        	['descripcion' => 'No Remunerativo No Bonificable' , 'created_at' => now()],
			        	['descripcion' => 'Adicionales Sociales' , 'created_at' => now()],
			        	['descripcion' => 'Descuento' , 'created_at' => now()],
			    	  ];
    	TipoCodigo::insert($tipocodigo);
    }
}
