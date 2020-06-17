<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrigenTableSeeder::class);
        $this->call(JurisdiccionTableSeeder::class);
        $this->call(OrganismoTableSeeder::class);
        $this->call(PeriodoTableSeeder::class);
        $this->call(TipoLiquidacionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TipoCodigoTableSeeder::class);
        $this->call(SubtipoCodigoTableSeeder::class);
        $this->call(ConceptoTableSeeder::class);
        $this->call(DeclaracionJuradaTableSeeder::class);
        $this->call(LiquidacionTableSeeder::class);
    }
}
