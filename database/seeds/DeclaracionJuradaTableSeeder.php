<?php

use Illuminate\Database\Seeder;
use App\DeclaracionJurada;

class DeclaracionJuradaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $declaraciones = [
            ['user_id' => 1, 'organismo_id' => 1,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 2,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 3,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 4,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 5,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 6,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 7,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 8,  'secuencia' => null, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 9,  'secuencia' => null, 'created_at' => now()],
        	['user_id' => 1, 'organismo_id' => 10,	'secuencia' => null, 'created_at' => now()],
        	['user_id' => 1, 'organismo_id' => 11,	'secuencia' => null, 'created_at' => now()],

        ];
        DeclaracionJurada::insert($declaraciones);
    }
}
