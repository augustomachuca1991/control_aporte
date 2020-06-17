<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class , 1)->create()->each(function (App\User  $user){
        //    $user->roles()->attach(1);
        //});
        $user = User::create(['name'  => 'Augusto Machuca',
		        		  	  'email' => 'augusto_fer22@hotmail.com', 
		        		      'password' => '$2y$10$k9xQj/8BU/cFJe53nFPcfuups5RhPorgikZiqUDl1KHx.L713o5Fy', //36269830
		        		     ]);
    	$user->roles()->attach(1);

    }
}

