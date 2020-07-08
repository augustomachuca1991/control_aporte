<?php

use Illuminate\Database\Seeder;
use App\LiquidacionDetalle;

class DetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiquidacionDetalle::insert([
        	['liquidacion_id' => 1,'concepto_id' => 1,'unidad' => '30 dias','importe' => 50000],
        	['liquidacion_id' => 1,'concepto_id' => 2,'unidad' => '34 años','importe' => 20000],
        	['liquidacion_id' => 1,'concepto_id' => 3,'unidad' => null,		'importe' => 50000],
        	['liquidacion_id' => 1,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 10000],
        	['liquidacion_id' => 1,'concepto_id' => 5,'unidad' => null,		'importe' => 50000],
        	['liquidacion_id' => 1,'concepto_id' => 6,'unidad' => '18,5 %', 'importe' => 9250],
        	['liquidacion_id' => 1,'concepto_id' => 7,'unidad' => '5%',		'importe' => 2500],
        	['liquidacion_id' => 1,'concepto_id' => 8,'unidad' => '1',		'importe' => 1000],
        	['liquidacion_id' => 1,'concepto_id' => 9,'unidad' => null,		'importe' => 100],

        	['liquidacion_id' => 2,'concepto_id' => 1,'unidad' => '30 dias','importe' => 25000],
        	['liquidacion_id' => 2,'concepto_id' => 2,'unidad' => '34 años','importe' => 10000],
        	['liquidacion_id' => 2,'concepto_id' => 3,'unidad' => null,		'importe' => 22000],
        	['liquidacion_id' => 2,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 87205],
        	['liquidacion_id' => 2,'concepto_id' => 5,'unidad' => null,		'importe' => 1250],
        	['liquidacion_id' => 2,'concepto_id' => 6,'unidad' => '18,5 %',	'importe' => 700],
        	['liquidacion_id' => 2,'concepto_id' => 7,'unidad' => '5%',		'importe' => 505],

        	['liquidacion_id' => 3,'concepto_id' => 1,'unidad' => '30 dias','importe' => 23000],
        	['liquidacion_id' => 3,'concepto_id' => 2,'unidad' => '34 años','importe' => 8000],
        	['liquidacion_id' => 3,'concepto_id' => 3,'unidad' => null,		'importe' => 18000],
        	['liquidacion_id' => 3,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 8720],
        	['liquidacion_id' => 3,'concepto_id' => 5,'unidad' => null,		'importe' => 1250],
        	['liquidacion_id' => 3,'concepto_id' => 6,'unidad' => '18,5 %',	'importe' => 700],
        	['liquidacion_id' => 3,'concepto_id' => 8,'unidad' => '1',		'importe' => 50],

        	['liquidacion_id' => 4,'concepto_id' => 1,'unidad' => '30 dias','importe' => 49000],
        	['liquidacion_id' => 4,'concepto_id' => 2,'unidad' => '34 años','importe' => 18000],
        	['liquidacion_id' => 4,'concepto_id' => 3,'unidad' => null,		'importe' => 48000],
        	['liquidacion_id' => 4,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 10000],
        	['liquidacion_id' => 4,'concepto_id' => 5,'unidad' => null,		'importe' => 46000],
        	['liquidacion_id' => 4,'concepto_id' => 6,'unidad' => '18,5 %', 'importe' => 11200],
        	['liquidacion_id' => 4,'concepto_id' => 7,'unidad' => '5%',		'importe' => 2500],
        	['liquidacion_id' => 4,'concepto_id' => 8,'unidad' => '1',      'importe' => 1000],
        	['liquidacion_id' => 4,'concepto_id' => 9,'unidad' => null,		'importe' => 100],

        	['liquidacion_id' => 5,'concepto_id' => 1,'unidad' => '30 dias','importe' => 36000],
        	['liquidacion_id' => 5,'concepto_id' => 2,'unidad' => '34 años','importe' => 20000],
        	['liquidacion_id' => 5,'concepto_id' => 3,'unidad' => null,		'importe' => 36000],
        	['liquidacion_id' => 5,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 16000],
        	['liquidacion_id' => 5,'concepto_id' => 5,'unidad' => null,		'importe' => 34000],
        	['liquidacion_id' => 5,'concepto_id' => 6,'unidad' => '18,5 %',	'importe' => 13000],
        	['liquidacion_id' => 5,'concepto_id' => 7,'unidad' => '5%',		'importe' => 3500],
        	['liquidacion_id' => 5,'concepto_id' => 8,'unidad' => '1',		'importe' => 1350],
        	['liquidacion_id' => 5,'concepto_id' => 9,'unidad' => null,		'importe' => 400],

        	['liquidacion_id' => 6,'concepto_id' => 1,'unidad' => '30 dias','importe' => 42000],
        	['liquidacion_id' => 6,'concepto_id' => 2,'unidad' => '34 años','importe' => 12000],
        	['liquidacion_id' => 6,'concepto_id' => 3,'unidad' => null,		'importe' => 38000],
        	['liquidacion_id' => 6,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 8000],
        	['liquidacion_id' => 6,'concepto_id' => 5,'unidad' => null,		'importe' => 40000],
        	['liquidacion_id' => 6,'concepto_id' => 6,'unidad' => '18,5 %', 'importe' => 8000],
        	['liquidacion_id' => 6,'concepto_id' => 7,'unidad' => '5%',		'importe' => 3000],
        	['liquidacion_id' => 6,'concepto_id' => 8,'unidad' => '1',		'importe' => 1500],
        	['liquidacion_id' => 6,'concepto_id' => 9,'unidad' => null,		'importe' => 130],

        	['liquidacion_id' => 7,'concepto_id' => 1,'unidad' => '30 dias','importe' => 35000],
        	['liquidacion_id' => 7,'concepto_id' => 2,'unidad' => '34 años','importe' => 23000],
        	['liquidacion_id' => 7,'concepto_id' => 3,'unidad' => null,		'importe' => 35000],
        	['liquidacion_id' => 7,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 13000],
        	['liquidacion_id' => 7,'concepto_id' => 5,'unidad' => null,		'importe' => 35000],
        	['liquidacion_id' => 7,'concepto_id' => 6,'unidad' => '18,5 %', 'importe' => 11250],
        	['liquidacion_id' => 7,'concepto_id' => 7,'unidad' => '5%',		'importe' => 4000],
        	['liquidacion_id' => 7,'concepto_id' => 8,'unidad' => '1',		'importe' => 1200],
        	['liquidacion_id' => 7,'concepto_id' => 9,'unidad' => null,		'importe' => 190],

        	['liquidacion_id' => 8,'concepto_id' => 1,'unidad' => '30 dias','importe' => 45000],
        	['liquidacion_id' => 8,'concepto_id' => 2,'unidad' => '34 años','importe' => 25000],
        	['liquidacion_id' => 8,'concepto_id' => 3,'unidad' => null,		'importe' => 35000],
        	['liquidacion_id' => 8,'concepto_id' => 4,'unidad' => '30 %',   'importe' => 15880],
        	['liquidacion_id' => 8,'concepto_id' => 5,'unidad' => null,		'importe' => 38000],
        	['liquidacion_id' => 8,'concepto_id' => 6,'unidad' => '18,5 %',	'importe' => 15000],
        	['liquidacion_id' => 8,'concepto_id' => 7,'unidad' => '5%',		'importe' => 2500],
        	['liquidacion_id' => 8,'concepto_id' => 8,'unidad' => '1',		'importe' => 800],
        	['liquidacion_id' => 8,'concepto_id' => 9,'unidad' => null,		'importe' => 90],

        	['liquidacion_id' => 9,'concepto_id' => 1,'unidad' => '30 dias','importe' => 40000],
        	['liquidacion_id' => 9,'concepto_id' => 2,'unidad' => '34 años','importe' => 19000],
        	['liquidacion_id' => 9,'concepto_id' => 3,'unidad' => null,		'importe' => 45000],
        	['liquidacion_id' => 9,'concepto_id' => 4,'unidad' => '30 %',	'importe' => 8000],
        	['liquidacion_id' => 9,'concepto_id' => 5,'unidad' => null,		'importe' => 38000],
        	['liquidacion_id' => 9,'concepto_id' => 6,'unidad' => '18,5 %',	'importe' => 10000],
        	['liquidacion_id' => 9,'concepto_id' => 7,'unidad' => '5%',		'importe' => 3000],
        	['liquidacion_id' => 9,'concepto_id' => 8,'unidad' => '1',		'importe' => 1250],
        	['liquidacion_id' => 9,'concepto_id' => 9,'unidad' => null,		'importe' => 85],

        	['liquidacion_id' => 10,'concepto_id' => 1,'unidad' => '30 dias','importe' => 33000],
        	['liquidacion_id' => 10,'concepto_id' => 2,'unidad' => '34 años','importe' => 16000],
        	['liquidacion_id' => 10,'concepto_id' => 3,'unidad' => null,	 'importe' => 28000],
        	['liquidacion_id' => 10,'concepto_id' => 4,'unidad' => '30 %',	 'importe' => 20000],
        	['liquidacion_id' => 10,'concepto_id' => 5,'unidad' => null,	 'importe' => 15000],
        	['liquidacion_id' => 10,'concepto_id' => 6,'unidad' => '18,5 %', 'importe' => 12000],
        	['liquidacion_id' => 10,'concepto_id' => 7,'unidad' => '5%',	 'importe' => 2500],
        	['liquidacion_id' => 10,'concepto_id' => 8,'unidad' => '1',		 'importe' => 1000],
        ]);
    }
}
