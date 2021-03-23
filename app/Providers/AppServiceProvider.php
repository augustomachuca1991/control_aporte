<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
                    //$event->menu->add('MAIN NAVIGATION');
            $notificationes = Notification::all();
                    $event->menu->add([
                                'text'        => '',
                                'url'         => '#',
                                'icon'        => 'far fa-bell',
                                'label'       => Notification::count(),
                                'label_color' => 'danger',
                                'topnav_right' => true,
                                'submenu' => [
                                        [
                                            'text' => 'importacion exitosa '.now(),
                                            'url'  => '#',
                                            'icon' => 'fas  fa-file-csv',
                                            // 'shift'   => 'ml-4',
                                        ],
                                        [
                                            'text' => 'ver usuarios',
                                            'url'  => '#',
                                            'icon' => 'fas  fa-users',
                                            // 'shift'   => 'ml-4',
                                        ],

                                ],
                            ]);
                });
    }
}
