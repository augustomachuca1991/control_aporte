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
        $liquidacion1 = Liquidacion::create([
                                                'declaracion_id' => 2, 
                                                'created_at'     => now()
                                            ]);
        $liquidacion2 = Liquidacion::create([
                                                'declaracion_id' => 3, 
                                                'created_at'     => now()
                                            ]);

        $organismo1 = Organismo::find(1);
        $organismo30 = Organismo::find(30);

        
        $liquidacion1->organismos()->attach($organismo1->cod_organismo,['periodo_id' => 25616 , 'tipo_id' => 1]);
        $liquidacion1->historia_laborales()->attach(1,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion2->organismos()->attach($organismo30->cod_organismo,['periodo_id' => 25616 , 'tipo_id' => 1]);
        $liquidacion2->historia_laborales()->attach(2,['estado_id' => 1 , 'funcion_id' => null]);
    }
}
