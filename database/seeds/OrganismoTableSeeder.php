<?php

use Illuminate\Database\Seeder;
use App\Organismo;

class OrganismoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organismos = [


            ['cod_organismo' => 1, 'jurisdiccion_id' =>  1, 'organismo' => 'MINISTERIO DE SEGURIDAD', 'created_at' => now()],
            ['cod_organismo' => 2, 'jurisdiccion_id' =>  2, 'organismo' => 'MINIS. DE HACIENDA Y FINANZAS', 'created_at' => now()],
            ['cod_organismo' => 3, 'jurisdiccion_id' =>  3, 'organismo' => 'MINISTERIO DE EDUCACIÓN', 'created_at' => now()],
            ['cod_organismo' => 4, 'jurisdiccion_id' =>  4, 'organismo' => 'SALUD PUBLICA', 'created_at' => now()],
            ['cod_organismo' => 5, 'jurisdiccion_id' =>  5, 'organismo' => 'MINISTERIO DE LA PRODUCCIÓN', 'created_at' => now()],
            ['cod_organismo' => 6, 'jurisdiccion_id' =>  6, 'organismo' => 'MRIO. DE OBRAS Y SERV. PÚBLICOS', 'created_at' => now()],
            ['cod_organismo' => 7, 'jurisdiccion_id' =>  7, 'organismo' => 'MINISTERIO SECRETARIA GENERAL', 'created_at' => now()],
            ['cod_organismo' => 8, 'jurisdiccion_id' =>  8, 'organismo' => 'HONORABLE TRIBUNAL DE CUENTAS', 'created_at' => now()],
            ['cod_organismo' => 9, 'jurisdiccion_id' =>  9, 'organismo' => 'PODER JUDICIAL', 'created_at' => now()],
            ['cod_organismo' => 11, 'jurisdiccion_id' => 11, 'organismo' => 'PODER LEGISLATIVO', 'created_at' => now()],
            ['cod_organismo' => 12, 'jurisdiccion_id' => 12, 'organismo' => 'FISCALÍA DE ESTADO', 'created_at' => now()],
            ['cod_organismo' => 13, 'jurisdiccion_id' => 13, 'organismo' => 'MINISTERIO DE COORDINACIÓN Y PLANIFICACIÓN', 'created_at' => now()],
            ['cod_organismo' => 14, 'jurisdiccion_id' => 14, 'organismo' => 'MINISTERIO DE DESARROLLO SOCIAL', 'created_at' => now()],
            ['cod_organismo' => 15, 'jurisdiccion_id' => 15, 'organismo' => 'DIRECCIÓN ENSEÑANZA PRIVADA', 'created_at' => now()],
            ['cod_organismo' => 16, 'jurisdiccion_id' => 16, 'organismo' => 'MINIST. DE JUSTICIA Y DERECHOS HUMANOS', 'created_at' => now()],
            ['cod_organismo' => 17, 'jurisdiccion_id' => 17, 'organismo' => 'SECRETARIA DE ENERGÍA', 'created_at' => now()],
            ['cod_organismo' => 18, 'jurisdiccion_id' => 18, 'organismo' => 'MINIST. DE INDUSTRIA, TRABAJO Y COMERCIO', 'created_at' => now()],
            ['cod_organismo' => 19, 'jurisdiccion_id' => 19, 'organismo' => 'MINISTERIO DE TURISMO', 'created_at' => now()],
            ['cod_organismo' => 21, 'jurisdiccion_id' => 21, 'organismo' => 'INSTITUTO LOTERÍA Y CASINOS', 'created_at' => now()],
            ['cod_organismo' => 22, 'jurisdiccion_id' => 22, 'organismo' => 'JEFATURA DE POLICÍA', 'created_at' => now()],
            ['cod_organismo' => 23, 'jurisdiccion_id' => 23, 'organismo' => 'ENSEÑANZA MEDIA Y SUPERIOR', 'created_at' => now()],
            ['cod_organismo' => 24, 'jurisdiccion_id' => 24, 'organismo' => 'INSTITUTO CORRENTINO DEL AGUA', 'created_at' => now()],
            ['cod_organismo' => 25, 'jurisdiccion_id' => 25, 'organismo' => 'VIALIDAD PROVINCIAL', 'created_at' => now()],
            ['cod_organismo' => 26, 'jurisdiccion_id' => 26, 'organismo' => 'INSTITUTO DE LA VIVIENDA', 'created_at' => now()],
            ['cod_organismo' => 27, 'jurisdiccion_id' => 27, 'organismo' => 'INSTIT. PROVINCIAL DEL TABACO', 'created_at' => now()],
            ['cod_organismo' => 29, 'jurisdiccion_id' => 29, 'organismo' => 'INSTITUTO PREVISIÓN SOCIAL', 'created_at' => now()],
            ['cod_organismo' => 30, 'jurisdiccion_id' => 30, 'organismo' => 'INSTITUTO DE DESARROLLO RURAL CORRIENTES', 'created_at' => now()],
            ['cod_organismo' => 31, 'jurisdiccion_id' => 31, 'organismo' => 'ADMINIST. DE OBRAS SANITARIAS', 'created_at' => now()],
            ['cod_organismo' => 32, 'jurisdiccion_id' => 32, 'organismo' => 'INST.OBRA SOCIAL DE LA PROVIN.', 'created_at' => now()],
            ['cod_organismo' => 33, 'jurisdiccion_id' => 33, 'organismo' => 'CONSEJO GENERAL DE EDUCACIÓN', 'created_at' => now()],
            ['cod_organismo' => 34, 'jurisdiccion_id' => 34, 'organismo' => 'INSTITUTO DE CARDIOLOGÍA', 'created_at' => now()],
            ['cod_organismo' => 37, 'jurisdiccion_id' => 37, 'organismo' => 'CONSEJO GENERAL DE EDUCACIÓN SUPLENTES', 'created_at' => now()],
            ['cod_organismo' => 38, 'jurisdiccion_id' => 38, 'organismo' => 'INSTITUTO DE CULTURA', 'created_at' => now()],

            ['cod_organismo' => 101, 'jurisdiccion_id' => 101, 'organismo' => 'Municipalidad de ALVEAR', 'created_at' => now()],
            ['cod_organismo' => 102, 'jurisdiccion_id' => 102, 'organismo' => 'Municipalidad de B. DE ASTRADA', 'created_at' => now()],
            ['cod_organismo' => 103, 'jurisdiccion_id' => 103, 'organismo' => 'Municipalidad de BELLA VISTA', 'created_at' => now()],
            ['cod_organismo' => 104, 'jurisdiccion_id' => 104, 'organismo' => 'Municipalidad de BOMPLAND', 'created_at' => now()],
            ['cod_organismo' => 105, 'jurisdiccion_id' => 105, 'organismo' => 'Municipalidad de C. C. PELLEGRINI', 'created_at' => now()],
            ['cod_organismo' => 106, 'jurisdiccion_id' => 106, 'organismo' => 'Municipalidad de C. MOCORETA', 'created_at' => now()],
            ['cod_organismo' => 107, 'jurisdiccion_id' => 107, 'organismo' => 'Municipalidad de CAA CATI', 'created_at' => now()],
            ['cod_organismo' => 108, 'jurisdiccion_id' => 108, 'organismo' => 'Municipalidad de CAJA MUNICIPAL DE PRESTAMOS', 'created_at' => now()],
            ['cod_organismo' => 109, 'jurisdiccion_id' => 109, 'organismo' => 'Municipalidad de CAROLINA', 'created_at' => now()],
            ['cod_organismo' => 110, 'jurisdiccion_id' => 110, 'organismo' => 'Municipalidad de CHAVARRIA', 'created_at' => now()],
            ['cod_organismo' => 111, 'jurisdiccion_id' => 111, 'organismo' => 'Municipalidad de COL. LIBERTAD', 'created_at' => now()],
            ['cod_organismo' => 112, 'jurisdiccion_id' => 112, 'organismo' => 'Municipalidad de COLONIA LIEBIG', 'created_at' => now()],
            ['cod_organismo' => 113, 'jurisdiccion_id' => 113, 'organismo' => 'Municipalidad de COLONIA PANDO', 'created_at' => now()],
            ['cod_organismo' => 114, 'jurisdiccion_id' => 114, 'organismo' => 'Municipalidad de CONCEPCION', 'created_at' => now()],
            ['cod_organismo' => 115, 'jurisdiccion_id' => 115, 'organismo' => 'Municipalidad de CRUZ DE LOS MILAGROS', 'created_at' => now()],
            ['cod_organismo' => 116, 'jurisdiccion_id' => 116, 'organismo' => 'Municipalidad de CTES. CAPITAL', 'created_at' => now()],
            ['cod_organismo' => 117, 'jurisdiccion_id' => 117, 'organismo' => 'Municipalidad de CURUZU CUATIA', 'created_at' => now()],
            ['cod_organismo' => 118, 'jurisdiccion_id' => 118, 'organismo' => 'Municipalidad de EL SOMBRERO', 'created_at' => now()],
            ['cod_organismo' => 119, 'jurisdiccion_id' => 119, 'organismo' => 'Municipalidad de EMPEDRADO', 'created_at' => now()],
            ['cod_organismo' => 120, 'jurisdiccion_id' => 120, 'organismo' => 'Municipalidad de ESQUINA', 'created_at' => now()],
            ['cod_organismo' => 121, 'jurisdiccion_id' => 121, 'organismo' => 'Municipalidad de ESTACION TORRENT', 'created_at' => now()],
            ['cod_organismo' => 122, 'jurisdiccion_id' => 122, 'organismo' => 'Municipalidad de FELIPE YOFRE', 'created_at' => now()],
            ['cod_organismo' => 123, 'jurisdiccion_id' => 123, 'organismo' => 'Municipalidad de GARRUCHOS', 'created_at' => now()],
            ['cod_organismo' => 124, 'jurisdiccion_id' => 124, 'organismo' => 'Municipalidad de GDOR. MARTINEZ', 'created_at' => now()],
            ['cod_organismo' => 125, 'jurisdiccion_id' => 125, 'organismo' => 'Municipalidad de GOB. VIRASORO', 'created_at' => now()],
            ['cod_organismo' => 126, 'jurisdiccion_id' => 126, 'organismo' => 'Municipalidad de GOYA', 'created_at' => now()],
            ['cod_organismo' => 127, 'jurisdiccion_id' => 127, 'organismo' => 'Municipalidad de GUAVIRAVI', 'created_at' => now()],
            ['cod_organismo' => 128, 'jurisdiccion_id' => 128, 'organismo' => 'Municipalidad de HERLITZKA', 'created_at' => now()],
            ['cod_organismo' => 129, 'jurisdiccion_id' => 129, 'organismo' => 'Municipalidad de ITA IBATE', 'created_at' => now()],
            ['cod_organismo' => 130, 'jurisdiccion_id' => 130, 'organismo' => 'Municipalidad de ITATI', 'created_at' => now()],
            ['cod_organismo' => 131, 'jurisdiccion_id' => 131, 'organismo' => 'Municipalidad de ITUZAINGO', 'created_at' => now()],
            ['cod_organismo' => 132, 'jurisdiccion_id' => 132, 'organismo' => 'Municipalidad de JOSE R.GOMEZ (GARAVI)', 'created_at' => now()],
            ['cod_organismo' => 133, 'jurisdiccion_id' => 133, 'organismo' => 'Municipalidad de JUAN PUJOL', 'created_at' => now()],
            ['cod_organismo' => 134, 'jurisdiccion_id' => 134, 'organismo' => 'Municipalidad de L. DE VALLEJOS', 'created_at' => now()],
            ['cod_organismo' => 135, 'jurisdiccion_id' => 135, 'organismo' => 'Municipalidad de LA CRUZ', 'created_at' => now()],
            ['cod_organismo' => 136, 'jurisdiccion_id' => 136, 'organismo' => 'Municipalidad de LAVALLE', 'created_at' => now()],
            ['cod_organismo' => 137, 'jurisdiccion_id' => 137, 'organismo' => 'Municipalidad de LORETO', 'created_at' => now()],
            ['cod_organismo' => 138, 'jurisdiccion_id' => 138, 'organismo' => 'Municipalidad de MARIANO I. LOZA', 'created_at' => now()],
            ['cod_organismo' => 139, 'jurisdiccion_id' => 139, 'organismo' => 'Municipalidad de MBURUCUYA', 'created_at' => now()],
            ['cod_organismo' => 140, 'jurisdiccion_id' => 140, 'organismo' => 'Municipalidad de MERCEDES', 'created_at' => now()],
            ['cod_organismo' => 141, 'jurisdiccion_id' => 141, 'organismo' => 'Municipalidad de MONTE CASEROS', 'created_at' => now()],
            ['cod_organismo' => 142, 'jurisdiccion_id' => 142, 'organismo' => 'Municipalidad de NUEVE DE JULIO', 'created_at' => now()],
            ['cod_organismo' => 143, 'jurisdiccion_id' => 143, 'organismo' => 'Municipalidad de P. DE LA PATRIA', 'created_at' => now()],
            ['cod_organismo' => 144, 'jurisdiccion_id' => 144, 'organismo' => 'Municipalidad de P. DE LOS LIBRES', 'created_at' => now()],
            ['cod_organismo' => 145, 'jurisdiccion_id' => 145, 'organismo' => 'Municipalidad de P. LIBERTADOR', 'created_at' => now()],
            ['cod_organismo' => 146, 'jurisdiccion_id' => 146, 'organismo' => 'Municipalidad de P. R. FERNANDEZ', 'created_at' => now()],
            ['cod_organismo' => 147, 'jurisdiccion_id' => 147, 'organismo' => 'Municipalidad de PAGO DE LOS DESEOS', 'created_at' => now()],
            ['cod_organismo' => 148, 'jurisdiccion_id' => 148, 'organismo' => 'Municipalidad de PALMAR GRANDE', 'created_at' => now()],
            ['cod_organismo' => 149, 'jurisdiccion_id' => 149, 'organismo' => 'Municipalidad de PARADA PUCHETA', 'created_at' => now()],
            ['cod_organismo' => 150, 'jurisdiccion_id' => 150, 'organismo' => 'Municipalidad de PERUGORRIA', 'created_at' => now()],
            ['cod_organismo' => 151, 'jurisdiccion_id' => 151, 'organismo' => 'Municipalidad de RAMADA PASO', 'created_at' => now()],
            ['cod_organismo' => 152, 'jurisdiccion_id' => 152, 'organismo' => 'Municipalidad de RIACHUELO', 'created_at' => now()],
            ['cod_organismo' => 153, 'jurisdiccion_id' => 153, 'organismo' => 'Municipalidad de S. L DEL PALMAR', 'created_at' => now()],
            ['cod_organismo' => 154, 'jurisdiccion_id' => 154, 'organismo' => 'Municipalidad de SALADAS', 'created_at' => now()],
            ['cod_organismo' => 155, 'jurisdiccion_id' => 155, 'organismo' => 'Municipalidad de SAN ANTONIO APIPE', 'created_at' => now()],
            ['cod_organismo' => 156, 'jurisdiccion_id' => 156, 'organismo' => 'Municipalidad de SAN CARLOS', 'created_at' => now()],
            ['cod_organismo' => 157, 'jurisdiccion_id' => 157, 'organismo' => 'Municipalidad de SAN COSME', 'created_at' => now()],
            ['cod_organismo' => 158, 'jurisdiccion_id' => 158, 'organismo' => 'Municipalidad de SAN ISIDRO', 'created_at' => now()],
            ['cod_organismo' => 159, 'jurisdiccion_id' => 159, 'organismo' => 'Municipalidad de SAN LORENZO', 'created_at' => now()],
            ['cod_organismo' => 160, 'jurisdiccion_id' => 160, 'organismo' => 'Municipalidad de SAN MIGUEL', 'created_at' => now()],
            ['cod_organismo' => 161, 'jurisdiccion_id' => 161, 'organismo' => 'Municipalidad de SAN ROQUE', 'created_at' => now()],
            ['cod_organismo' => 162, 'jurisdiccion_id' => 162, 'organismo' => 'Municipalidad de SANTA ANA', 'created_at' => now()],
            ['cod_organismo' => 163, 'jurisdiccion_id' => 163, 'organismo' => 'Municipalidad de SANTA LUCIA', 'created_at' => now()],
            ['cod_organismo' => 164, 'jurisdiccion_id' => 164, 'organismo' => 'Municipalidad de SANTA ROSA', 'created_at' => now()],
            ['cod_organismo' => 165, 'jurisdiccion_id' => 165, 'organismo' => 'Municipalidad de SANTO TOME', 'created_at' => now()],
            ['cod_organismo' => 166, 'jurisdiccion_id' => 166, 'organismo' => 'Municipalidad de SAUCE', 'created_at' => now()],
            ['cod_organismo' => 167, 'jurisdiccion_id' => 167, 'organismo' => 'Municipalidad de TABAY', 'created_at' => now()],
            ['cod_organismo' => 168, 'jurisdiccion_id' => 168, 'organismo' => 'Municipalidad de TAPEBICUA', 'created_at' => now()],
            ['cod_organismo' => 169, 'jurisdiccion_id' => 169, 'organismo' => 'Municipalidad de TATACUA', 'created_at' => now()],
            ['cod_organismo' => 170, 'jurisdiccion_id' => 170, 'organismo' => 'Municipalidad de TRES DE ABRIL', 'created_at' => now()],
            ['cod_organismo' => 171, 'jurisdiccion_id' => 171, 'organismo' => 'Municipalidad de VILLA OLAVARI', 'created_at' => now()],
            ['cod_organismo' => 172, 'jurisdiccion_id' => 172, 'organismo' => 'Municipalidad de YAPEYU', 'created_at' => now()],
            ['cod_organismo' => 173, 'jurisdiccion_id' => 173, 'organismo' => 'Municipalidad de YATAITI CALLE', 'created_at' => now()],


            ['cod_organismo' => 1000, 'jurisdiccion_id' => 1000, 'organismo' => 'Direccion Provincial de energias de Ctes', 'created_at' => now()],




        ];
        Organismo::insert($organismos);
    }
}
