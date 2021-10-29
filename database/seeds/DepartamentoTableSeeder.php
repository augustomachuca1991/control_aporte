<?php

use App\Dpto;
use Illuminate\Database\Seeder;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dpto = [
            ['departamento'=> 'Recurso y Contralor', 'created_at' => now()],
            ['departamento'=> 'Recurso y Contralor 2', 'created_at' => now()]

        ];
        Dpto::insert($dpto);
    }
}
