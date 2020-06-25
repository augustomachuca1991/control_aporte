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
        $categorias = Categoria::create([
            'cod_categoria' => 1, 'categoria' => 'Docentes' ,  'created_at' => now()
        ]);

        $categoria->jurisdicciones()->attach(2);
    }
}
