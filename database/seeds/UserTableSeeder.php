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
		        		      'password' => '$2y$10$jtFMq6os0fUXeFvtVZQqm.M1g7/AK9mTthBgXNgPH2JYSfo4Fd3cG', //12345678
		        		     ]);
    	$user->roles()->attach(1);

    }
}

