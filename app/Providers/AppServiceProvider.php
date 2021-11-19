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
        // $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
        //     $event->menu->add('© Copyright 2021');
        //     $user = Auth::user();
        //     $notificationes = $user->notifications->where('type', 'App\Notifications\FinishJob')->all();
        //     if ($notificationes) {
        //         foreach ($notificationes as $notificacion) {
        //             $menu[] = [
        //                 'text' => $notificacion->data,
        //                 'url'  => '#',
        //                 'icon' => 'fa fas-edit',
        //             ];
        //         }
        //     } else {
        //         $menu[] = [
        //             'text' => 'sin notificaciones',
        //             'url'  => '#',
        //             'icon' => 'fas  fa-file-csv',
        //         ];
        //     }


        //     $event->menu->add([
        //         'text'        => '',
        //         'url'         => '#',
        //         'icon'        => 'far fa-bell',
        //         'label'       => $notificationes->count(),
        //         'label_color' => 'danger',
        //         'topnav_right' => true,
        //         'submenu' => $menu,
        //     ]);
        // });
    }
}
