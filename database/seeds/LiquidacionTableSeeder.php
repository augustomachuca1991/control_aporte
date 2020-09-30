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
        $liquidacion1 = Liquidacion::create(['declaracion_id' => 1, 'created_at'=> now()]);
        $liquidacion2 = Liquidacion::create(['declaracion_id' => 2, 'created_at'=> now()]);
        $liquidacion3 = Liquidacion::create(['declaracion_id' => 3, 'created_at'=> now()]);
        $liquidacion4 = Liquidacion::create(['declaracion_id' => 4, 'created_at'=> now()]);
        $liquidacion5 = Liquidacion::create(['declaracion_id' => 5, 'created_at'=> now()]);
        $liquidacion6 = Liquidacion::create(['declaracion_id' => 6, 'created_at'=> now()]);
        $liquidacion7 = Liquidacion::create(['declaracion_id' => 7, 'created_at'=> now()]);
        $liquidacion8 = Liquidacion::create(['declaracion_id' => 8, 'created_at'=> now()]);
        $liquidacion9 = Liquidacion::create(['declaracion_id' => 9, 'created_at'=> now()]);
        $liquidacion10 = Liquidacion::create(['declaracion_id' => 10, 'created_at'=> now()]);

        $organismo1 = Organismo::find(1);
        $organismo2 = Organismo::find(2);
        $organismo3 = Organismo::find(3);
        $organismo4 = Organismo::find(4);
        $organismo5 = Organismo::find(5);
        $organismo6 = Organismo::find(6);
        $organismo7 = Organismo::find(7);
        $organismo20 = Organismo::find(20);
        $organismo21 = Organismo::find(21);
        $organismo30 = Organismo::find(30);

        
        $liquidacion1->organismos()->attach($organismo1->cod_organismo,['periodo_id' => 202005 , 'tipo_id' => 1]);
        $liquidacion1->historia_laborales()->attach(1,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion2->organismos()->attach($organismo2->cod_organismo,['periodo_id' => 202005 , 'tipo_id' => 1]);
        $liquidacion2->historia_laborales()->attach(2,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion3->organismos()->attach($organismo3->cod_organismo,['periodo_id' => 202005 , 'tipo_id' => 1]);
        $liquidacion3->historia_laborales()->attach(3,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion4->organismos()->attach($organismo4->cod_organismo,['periodo_id' => 202005 , 'tipo_id' => 1]);
        $liquidacion4->historia_laborales()->attach(4,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion5->organismos()->attach($organismo5->cod_organismo,['periodo_id' => 202005 , 'tipo_id' => 1]);
        $liquidacion5->historia_laborales()->attach(5,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion6->organismos()->attach($organismo6->cod_organismo,['periodo_id' => 202006 , 'tipo_id' => 1]);
        $liquidacion6->historia_laborales()->attach(6,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion7->organismos()->attach($organismo7->cod_organismo,['periodo_id' => 202006 , 'tipo_id' => 1]);
        $liquidacion7->historia_laborales()->attach(7,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion8->organismos()->attach($organismo20->cod_organismo,['periodo_id' => 202006 , 'tipo_id' => 1]);
        $liquidacion8->historia_laborales()->attach(8,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion9->organismos()->attach($organismo21->cod_organismo,['periodo_id' => 202006 , 'tipo_id' => 1]);
        $liquidacion9->historia_laborales()->attach(9,['estado_id' => 1 , 'funcion_id' => null]);

        $liquidacion10->organismos()->attach($organismo30->cod_organismo,['periodo_id' => 202006 , 'tipo_id' => 1]);
        $liquidacion10->historia_laborales()->attach(10,['estado_id' => 1 , 'funcion_id' => null]);
    }
}
