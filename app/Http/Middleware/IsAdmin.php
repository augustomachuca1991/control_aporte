<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
         if(auth()->check()){
            $user   = auth()->user();
            foreach ($user->roles as $role){
                if ($role->pivot->role_id == 1) {
                    $request->user = $user;
                    return $next($request);
                }
            }
            return redirect()->route('home');
         }else{
            return redirect()->route('login');
        }
    }
}
