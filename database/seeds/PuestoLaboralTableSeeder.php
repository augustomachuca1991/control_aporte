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
        	$puestolaboral->clases()->attach(rand(1,4),['fecha_inicio' => now()->firstOfMonth(),'fecha_fin' => now()->endOfMonth()->modify('0 month')->toDateString()]);
        }
    }
}
