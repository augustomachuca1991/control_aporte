<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        	['cod_rol'=> 1, 'rol' => 'Administrador', 'created_at' => now() ],
        	['cod_rol'=> 2, 'rol' => 'Usuario', 'created_at' => now()],
            
    	];
    	Role::insert($roles);
    }
}
