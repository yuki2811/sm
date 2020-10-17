<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Classes;
use Illuminate\Support\Facades\Auth;
class CheckUserPer
{

    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {   
            $class = $request->classid;
            $subj = $request->subjectid;
            $user = Auth::user();
            if ($user->super_admin == 0) {
                return $next($request);
            }elseif ($user->super_admin == 1) {
                return $next($request);
            }else{
                $clas = User::find($user->id)->classes->toArray();
                foreach ($clas as $value) {
                    if ($value['id'] == $class && $user->subject_id == $subj ) {
                        return $next($request);
                    }
                }
            }
 return redirect('trangchu');
        }else{
            return redirect('login');
        }
    }
}
