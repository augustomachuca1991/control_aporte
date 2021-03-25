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
            if ($notificationes->count() > 0) {
                foreach ($notificationes as $key) {
                    $menu[] = [
                        'text' => $key->data.' '.$key->created_at->diffForHumans(),
                        'url'  => '#',
                        'icon' => 'fas  fa-bell',
                        'icon_color'   => 'maroon',
                    ];
                }
            }else{
                $menu[] = [
                        'text' => 'sin notificaciones',
                        'url'  => '#',
                        'icon' => 'fas  fa-file-csv',
                        // 'shift'   => 'ml-4',
                    ];
            }


                $event->menu->add([
                            'text'        => '',
                            'url'         => '#',
                            'icon'        => 'far fa-bell',
                            'label'       => $notificationes->count(),
                            'label_color' => 'danger',
                            'topnav_right' => true,
                            'submenu' => $menu,
                        ]);
                });
    }
}
