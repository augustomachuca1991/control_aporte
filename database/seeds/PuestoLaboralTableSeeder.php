<?php

use Illuminate\Database\Seeder;
use App\PuestoLaboral;

class PuestoLaboralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puestosLaborales = PuestoLaboral::all();
        foreach ($puestosLaborales as $puestolaboral) {
        	$puestolaboral->clases()->attach(rand(1,4),['fecha_ingreso' => now()->subMinutes(rand(1, 55)),]);
        }
    }
}
