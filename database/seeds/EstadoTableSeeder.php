<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [ 
	        ['cod_estado'=> 1,'organismo_id' => 1,'estado'=>'Activo'],
	        ['cod_estado'=> 2,'organismo_id' => 1,'estado'=>'Pendiente'],
	        ['cod_estado'=> 3,'organismo_id' => 1,'estado'=>'Anulado'],
	        ['cod_estado'=> 4,'organismo_id' => 1,'estado'=>'Baja'],
	        ['cod_estado'=> 5,'organismo_id' => 1,'estado'=>'Promocion'],
	        ['cod_estado'=> 6,'organismo_id' => 1,'estado'=>'Retirado'],
	        ['cod_estado'=> 7,'organismo_id' => 1,'estado'=>'Incapacidad laboral Temporaria (ILT)'],
	        ['cod_estado'=> 8,'organismo_id' => 1,'estado'=>'Baja por Documento Erróneo'],
	        ['cod_estado'=> 9,'organismo_id' => 1,'estado'=>'Licencia sin Goce de Haberes'],
	        ['cod_estado'=> 10,'organismo_id' => 1,'estado'=>'Suplencia'],
	        ['cod_estado'=> 11,'organismo_id' => 1,'estado'=>'Interino'],
	        ['cod_estado'=> 12,'organismo_id' => 1,'estado'=>'Retención Cargo (Suplencia Docentes)'],
	        ['cod_estado'=> 13,'organismo_id' => 1,'estado'=>'Baja en Trámite'],
	        ['cod_estado'=> 14,'organismo_id' => 1,'estado'=>'Retención Cargo (Por Mayor Designación)'],
	        ['cod_estado'=> 15,'organismo_id' => 1,'estado'=>'Cesantia'],
	        ['cod_estado'=> 16,'organismo_id' => 1,'estado'=>'Exoneracion'],
	        ['cod_estado'=> 18,'organismo_id' => 1,'estado'=>'Retiro Voluntario'],
	        ['cod_estado'=> 19,'organismo_id' => 1,'estado'=>'Retiro Obligatorio'],
	        ['cod_estado'=> 21,'organismo_id' => 1,'estado'=>'Baja Retiro Voluntario ley 5430'],
	        ['cod_estado'=> 22,'organismo_id' => 1,'estado'=>'BOCEP'],
	        ['cod_estado'=> 23,'organismo_id' => 1,'estado'=>'Activo/Pendiente'],
	        ['cod_estado'=> 24,'organismo_id' => 1,'estado'=>'Suplen/Pendiente'],
	        ['cod_estado'=> 25,'organismo_id' => 1,'estado'=>'Interino/Pendiente'],
	        ['cod_estado'=> 26,'organismo_id' => 1,'estado'=>'Activa.de Lic y/o Retec. /Pendiente'],
	        ['cod_estado'=> 27,'organismo_id' => 1,'estado'=>'Retiro Voluntario Anticipado ley 5430'],
	        ['cod_estado'=> 28,'organismo_id' => 1,'estado'=>'Ad Honorem'],
	        ['cod_estado'=> 29,'organismo_id' => 1,'estado'=>'Incompatib. de Horas'],
	        ['cod_estado'=> 30,'organismo_id' => 1,'estado'=>'Baja Con Aguinaldo'],
	        ['cod_estado'=> 31,'organismo_id' => 1,'estado'=>'Baja con deuda'],
	        ['cod_estado'=> 32,'organismo_id' => 1,'estado'=>'Baja por Termino de Suplencia'],
	        ['cod_estado'=> 33,'organismo_id' => 1,'estado'=>'Sujeto a Control'],
	        ['cod_estado'=> 34,'organismo_id' => 1,'estado'=>'Complementaria'],
	        ['cod_estado'=> 35,'organismo_id' => 2,'estado'=>'Activo'],
	        ['cod_estado'=> 36,'organismo_id' => 2,'estado'=>'Pendiente'],
	        ['cod_estado'=> 37,'organismo_id' => 2,'estado'=>'Anulado'],
	        ['cod_estado'=> 38,'organismo_id' => 2,'estado'=>'Baja'],
	        ['cod_estado'=> 39,'organismo_id' => 2,'estado'=>'Promocion'],
	        ['cod_estado'=> 40,'organismo_id' => 2,'estado'=>'Retirado'],
	        ['cod_estado'=> 41,'organismo_id' => 2,'estado'=>'Incapacidad laboral Temporaria (ILT)'],
	        ['cod_estado'=> 42,'organismo_id' => 2,'estado'=>'Baja por Documento Erróneo'],
	        ['cod_estado'=> 43,'organismo_id' => 2,'estado'=>'Licencia sin Goce de Haberes'],
	        ['cod_estado'=> 44,'organismo_id' => 2,'estado'=>'Suplencia'],
	        ['cod_estado'=> 45,'organismo_id' => 2,'estado'=>'Interino'],
	        ['cod_estado'=> 46,'organismo_id' => 2,'estado'=>'Retención Cargo (Suplencia Docentes)'],
	        ['cod_estado'=> 47,'organismo_id' => 2,'estado'=>'Baja en Trámite'],
	        ['cod_estado'=> 48,'organismo_id' => 2,'estado'=>'Retención Cargo (Por Mayor Designación)'],
	        ['cod_estado'=> 49,'organismo_id' => 2,'estado'=>'Cesantia'],
	        ['cod_estado'=> 50,'organismo_id' => 2,'estado'=>'Exoneracion'],
	        ['cod_estado'=> 51,'organismo_id' => 2,'estado'=>'Retiro Voluntario'],
	        ['cod_estado'=> 52,'organismo_id' => 2,'estado'=>'Retiro Obligatorio'],
	        ['cod_estado'=> 53,'organismo_id' => 2,'estado'=>'Baja Retiro Voluntario ley 5430'],
	        ['cod_estado'=> 54,'organismo_id' => 2,'estado'=>'BOCEP'],
	        ['cod_estado'=> 55,'organismo_id' => 2,'estado'=>'Activo/Pendiente'],
	        ['cod_estado'=> 56,'organismo_id' => 2,'estado'=>'Suplen/Pendiente'],
	        ['cod_estado'=> 57,'organismo_id' => 2,'estado'=>'Interino/Pendiente'],
	        ['cod_estado'=> 58,'organismo_id' => 2,'estado'=>'Activa.de Lic y/o Retec. /Pendiente'],
	        ['cod_estado'=> 59,'organismo_id' => 2,'estado'=>'Retiro Voluntario Anticipado ley 5430'],
	        ['cod_estado'=> 60,'organismo_id' => 2,'estado'=>'Ad Honorem'],
	        ['cod_estado'=> 61,'organismo_id' => 2,'estado'=>'Incompatib. de Horas'],
	        ['cod_estado'=> 62,'organismo_id' => 2,'estado'=>'Baja Con Aguinaldo'],
	        ['cod_estado'=> 63,'organismo_id' => 2,'estado'=>'Baja con deuda'],
	        ['cod_estado'=> 64,'organismo_id' => 2,'estado'=>'Baja por Termino de Suplencia'],
	        ['cod_estado'=> 65,'organismo_id' => 2,'estado'=>'Sujeto a Control'],
	        ['cod_estado'=> 66,'organismo_id' => 2,'estado'=>'Complementaria']
        ];
        Estado::Insert($estados);
    }
}
