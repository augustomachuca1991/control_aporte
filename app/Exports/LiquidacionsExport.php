j<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{FromQuery,WithHeadings,Exportable,WithDrawings, WithProperties, WithCustomCsvSettings};
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\DeclaracionJuradaLine;
use Exception;

class LiquidacionsExport implements FromQuery, WithHeadings, ShouldQueue, WithDrawings, WithProperties, WithCustomCsvSettings
{
    use Exportable;
 
    protected $cod_periodo;

    public function __construct(int $cod_periodo)
    {
      $this->cod_periodo = $cod_periodo;
    }

   /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'declaracionjurada',
            'nombre',
            'cuil',
            'fecha_nac',
            'sexo',
            'puesto_laboral',
            'cargo',
            'fecha_ingreso',
            'cod_categoria',
            'categoria',
            'cod_clase',
            'clase',
            'cod_estado',
            'estado',
            'cod_jurisdiccion',
            'jurisdiccion',
            'cod_organismo',
            'organismo',
            'haber_bruto',
            'aporte_personal',
            'aporte_estatal',
            'basico',
            'antiguedad',
            'adicional',
            'familiar',
            'hijo',
            'esposa',
            'otros',
            'cod_funcion',
            'funcion',         
        ];
    }

    public function query()
    {
        try {
        	return DeclaracionJuradaLine::query();
        } catch (Exception $e) {
        	\Log::debug('Fallo al decargar: '.$e->getMessagge());	
        }
        //->where('cod_periodo',$this->cod_periodo);
    }
        	

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('IPS');
        $drawing->setDescription('Instituto de Previsión Social');
        $drawing->setPath(public_path('/image/ips.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B3');

        return $drawing;
    }

    public function properties(): array
    {
        return [
            'creator' => 'Machuca Augusto',
            'title' => 'Ips corrientes',
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '@',
            'enclosure' => '',
            'input_encoding' => 'UTF-8'
        ];
    }
}
