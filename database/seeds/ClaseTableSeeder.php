<?php

use Illuminate\Database\Seeder;
use App\Clase;

class ClaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clases = [ 
            ['categoria_id' => 1, 'clase' => 'Auxiliar de direccion' ,            'created_at' => now()],
            ['categoria_id' => 1, 'clase' => 'Bibliotecario' ,                    'created_at' => now()],
            ['categoria_id' => 1, 'clase' => 'Director de escuela común de 1ra' , 'created_at' => now()],
            ['categoria_id' => 1, 'clase' => 'Maestro de Grado Escuela comun' ,   'created_at' => now()],
    
        ];

        Clase::insert($clases);
    }
}
