<?php

use Illuminate\Database\Seeder;
use App\Liquidacion;

class LiquidacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $liquidaciones = [
        	
        	['declaracion_id' => 2, 'created_at' => now()],
        
        ];
        Liquidacion::insert($liquidaciones);
    }
}
