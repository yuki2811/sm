<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
class CheckUser
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
        if(Auth::check())
        {   
            $user = Auth::user();
            if ($user->active == 0 ) {
                return $next($request);
            }else{
                Auth::logout();
                return redirect('login')->with('thongbao','Bạn đã bị chặn');
            }
            
        }else{
            return redirect('login');
        }
    }
}
