<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;
use App\Notification;

use function GuzzleHttp\json_decode;

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
            $event->menu->add('© Copyright 2021');
            $notificationes = Notification::where('notifiable_id', Auth::id())->get();
            if ($notificationes->count() > 0) {
                foreach ($notificationes as $notificacion) {
                    $menu[] = [
                        'text' => json_decode($notificacion->data, true)['message'],
                        'url'  => '#',
                        'icon' => json_decode($notificacion->data, true)['icon'],
                    ];
                }
            } else {
                $menu[] = [
                    'text' => 'sin notificaciones',
                    'url'  => '#',
                    'icon' => 'fas  fa-file-csv',
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
