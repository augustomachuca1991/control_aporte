<?php

use Illuminate\Database\Seeder;
use App\HistoriaLaboral;
use Illuminate\Support\Carbon;

class HistoriaLaboralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$hl = [
	    //    	['puesto_id' => 516 , 'clase_id' => 1, 'fecha_inicio' => now()->subMinutes(rand(1, 55)),'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(), 'created_at' => now()],
	    //    	['puesto_id' => 515 , 'clase_id' => 2, 'fecha_inicio' => now()->subMinutes(rand(1, 55)),'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString(), 'created_at' => now()],
	    //	];
    	//HistoriaLaboral::insert($hl);
    }
}
