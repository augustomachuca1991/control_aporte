<?php

use Illuminate\Database\Seeder;
use App\Liquidacion;
use App\Organismo;

class LiquidacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $liquidacion = Liquidacion::create([
                                                'declaracion_id' => 2, 
                                                'created_at'     => now()
                                            ]);

        
        $organismos = Organismo::find(1);
        $periodo    = 25616;
        $tipo_liquidacion = 1;
        $liquidacion->organismos()->attach($organismos->cod_organismo,['periodo_id' => 25616 , 'tipo_id' => 1]);

        $liquidacion->historia_laborales()->attach(1,['estado_id' => 1 , 'funcion_id' => null]);
    }
}
