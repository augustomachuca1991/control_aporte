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
        	['user_id' => 1, 'organismo_id' => 29,	'secuencia' => null, 'created_at' => now()],
        	['user_id' => 1, 'organismo_id' => 29,	'secuencia' => 1, 'created_at' => now()],
            ['user_id' => 1, 'organismo_id' => 30,  'secuencia' => null, 'created_at' => now()],
        ];
        DeclaracionJurada::insert($declaraciones);
    }
}
