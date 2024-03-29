<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $roles = [
        // 	['cod_rol'=> 1, 'rol' => 'Administrador', 'created_at' => now() ],
        // 	['cod_rol'=> 2, 'rol' => 'Usuario', 'created_at' => now()],
            
    	// ];
    	// Role::insert($roles);
        $admin  = Role::create(['name' => 'admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]); 
        $usuario = Role::create(['name' => 'usuario', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);


        // Permission::create(['name' => 'importar archivo', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()])->syncRoles([$admin, $usuario]); 
        // Permission::create(['name' => 'var archivo', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()])->syncRoles([$admin, $usuario]); 
        // Permission::create(['name' => 'eliminar archivo', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()])->syncRoles([$admin, $usuario]); 
        // Permission::create(['name' => 'editar archvo', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()])->syncRoles([$admin, $usuario]); 

        $importar = Permission::create(['name' => 'importar csv', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $categorias = Permission::create(['name' => 'listar categorias', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $clases = Permission::create(['name' => 'listar clases', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $jurisdicciones = Permission::create(['name' => 'listar jurisdicciones', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $organismos = Permission::create(['name' => 'listar organismos', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $usuarios = Permission::create(['name' => 'listar usuarios', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $periodos = Permission::create(['name' => 'periodos', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $btn_dashboard = Permission::create(['name' => 'ver botones panel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $ddjj = Permission::create(['name' => 'listar ddjj', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);


        $importar->syncRoles([$admin,$usuario]);
        $categorias->syncRoles([$admin]);
        $clases->syncRoles([$admin]);
        $jurisdicciones->syncRoles([$admin]);
        $organismos->syncRoles([$admin]);
        $usuarios->syncRoles([$admin]);
        $periodos->syncRoles([$admin, $usuario]);
        $btn_dashboard->syncRoles([$admin]);
        $ddjj->syncRoles([$admin]);




    }
}
