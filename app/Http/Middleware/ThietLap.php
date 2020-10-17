<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
class ThietLap
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
            if ($user->super_admin == 0 || $user->super_admin == 1 ) {
                return $next($request);
            }else{
                return redirect('trangchu');
            }
            
        }else{
            return redirect('login');
        }
    }
}
