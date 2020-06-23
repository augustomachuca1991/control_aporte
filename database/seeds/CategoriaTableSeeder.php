<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [ 
            ['cod_categoria' => 1, 'categoria' => 'Docentes' ,  'created_at' => now()],
            ['cod_categoria' => 2, 'categoria' => 'Clero' , 	'created_at' => now()],
            ['cod_categoria' => 3, 'categoria' => 'DPEC' , 	    'created_at' => now()],
            ['cod_categoria' => 4, 'categoria' => 'Carcelario' ,'created_at' => now()],
        ];

        Categoria::insert($categorias);
    }
}
