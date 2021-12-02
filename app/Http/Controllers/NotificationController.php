<?php

namespace App\Http\Controllers;

use App\{Notification,User};
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notificaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function getNotificaciones()
    {
        
        return Notification::all();
    
    }



    public function notReadNotifications($user_id)
    {

        $notification_no_leidas = User::find($user_id)->unreadNotifications->where('type', 'App\Notifications\FinishJob')->all();
        // return $notification_no_leidas->sortByDesc('created_at');
        $notifications = [];
        foreach ($notification_no_leidas as $key => $noRead) {
            $array = [
                'id' => $noRead->id,
                'icon' => 'fas fa-fw fa-envelope text-warning',
                'text' => $noRead->data['message'],
                'time' => $noRead->created_at->diffForHumans(),
            ];
            $notifications[$key] = $array;
                
        }
    
        $dropdownHtml = '';
    
        foreach ($notifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";
    
            $time = "<span class='float-right text-muted text-sm'>
                       {$not['time']}
                     </span>";
    
            $dropdownHtml .= "<a href='api/notification/leida/'".$not['id']." class='dropdown-item text-sm'>
                                {$icon}{$not['text']}{$time}
                              </a>";
    
            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }
    
        // Return the new notification data.
    
        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];
    }



    public function markAsReads(Request $request)
    {   

        $notification = Notification::find($request->id);
        $notification->update(['read_at' => now()]);
        $notification->save();
        //return $this->getNotificaciones();

    }

}
