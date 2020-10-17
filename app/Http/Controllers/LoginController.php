<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\User;
class LoginController extends Controller
{
    //
    public function getLogin()
    {
    	return view('page.login');
    }

    public function postLogin(Request $request){
        $this->validate($request,[
            'account'=>'required',
            'password'=>'required|min:6'
            ],[
            'account.required'=>'Bạn chưa nhập tài khoản',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'mật khẩu phải lớn hơn 6 ký tự',
            ]
        );

        $account = $request['account'];
        $password = $request['password'];
        $remember_me = $request->has('remember_me') ? true : false; 

        if(Auth::attempt(['account'=>$account,'password'=>$password], $remember_me)){
            return redirect('trangchu');
        }
        else{
            return redirect('login')->with('thongbao','Sai tên đăng nhập hoặc mật khẩu');
        }
        
    }


    public function outLogin(Request $request){
        Auth::logout();
        return view('page.login');
    }
}
