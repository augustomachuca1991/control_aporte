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
                    $event->menu->add([
                                'text'        => '',
                                'url'         => 'admin/users',
                                'icon'        => 'far fa-bell',
                                'label'       => Notification::count(),
                                'label_color' => 'danger',
                                'topnav_right' => true,
                            ]);
                });
    }
}
