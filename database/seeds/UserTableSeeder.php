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
        
        $user = User::create(['name'  => 'Augusto Machuca',
		        		  	  'email' => 'augusto_fer22@hotmail.com', 
		        		      'password' => '$2y$10$jtFMq6os0fUXeFvtVZQqm.M1g7/AK9mTthBgXNgPH2JYSfo4Fd3cG', //12345678
                             ]);
        $user2 = User::create(['name'  => 'Sol Galain',
                             'email' => 'solgalain@gmail.com', 
                             'password' => '$2y$10$jtFMq6os0fUXeFvtVZQqm.M1g7/AK9mTthBgXNgPH2JYSfo4Fd3cG', //12345678
                            ]);
        $user3 = User::create(['name'  => 'user guest',
            'email' => 'user@gmail.com', 
            'password' => '$2y$10$jtFMq6os0fUXeFvtVZQqm.M1g7/AK9mTthBgXNgPH2JYSfo4Fd3cG', //12345678
        ]);
        $user->assignRole('admin');
        $user2->assignRole('admin');
        $user3->assignRole('usuario');

        factory(App\User::class , 50)->create()->each(function (App\User  $user){
            $user->assignRole('usuario');
         });

    }
}

