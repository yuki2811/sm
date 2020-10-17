<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\User;
use App\Semester;
use App\Subject;
use App\Classes;
class UserController extends Controller
{
    public function getUser()
    {
    	$user = User::all()->toArray();
    	$classes = Classes::all()->toArray();
    	return view('page.dashboard',['user'=>$user,'clas'=>$classes]);
    }
    public function userIndex()
    {
    	$user = User::all()->toArray();
    	$subject = Subject::all()->toArray();
    	$classes = Classes::all()->toArray();
    	return view('page.users.userindex',['user'=>$user, 'subject'=>$subject,'clas'=>$classes]);
    }
    public function userAdd()
    {
        $subject = Subject::all()->toArray();
        return view('page.users.adduser',[ 'subject'=>$subject]);
    }
    public function postUserAdd(Request $request)
    {

        $this->validate($request,[
            'name' =>'required',
            'birthday'=>'required',
            'account'=>'required',
            'password'=>'required|min:6|max:32',
            'repassword' =>'required|same:password',
            'superadmin' =>'required'
            ],[
            'name.required'=>'Bạn chưa nhập tên',
            'birthday.required'=>'Bạn chưa nhập ngày sinh',
            'account.required'=>'Bạn chưa nhập tên đăng nhập',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'mật khẩu phải lớn hơn 6 ký tự',
            'password.max'=>'mật khẩu phải nhở hơn 32 ký tự',
            'repassword.same'=>'mật khẩu không trùng khớp',
            'superadmin.required'=>'Bạn chưa chọn quyền'
            ]
        );
        $acc = User::where('account', $request->account)->count();
        if ($acc > 0) {
            return redirect()->back()->with('thongbao','tài khoản đã tồn tại!');
        }
        $user = new User;
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->password = bcrypt($request->password);
        $user->account = $request->account;
        $user->super_admin = $request->superadmin;
        $user->subject_id = $request->subjectid;
        $user->save();
        return redirect('admin/users/danhsachnguoidung')->with('thongbao','Thêm thành công');
    }
    public function userEdit($id)
    {
        $user = User::find($id)->toArray();
        $classes = Classes::all()->toArray();
        $sem = Semester::all()->toArray();
        $subject = Subject::all()->toArray();
        return view('page.users.edituser',['users' => $user, 'subject'=>$subject, 'classes' => $classes, 'seme' => $sem]);
    }

    public function postUserEdit(Request $request,$id)
    {

        $this->validate($request,[
            'name' =>'required',
            'birthday'=>'required',
            'superadmin' =>'required'
            ],[
            'name.required'=>'Bạn chưa nhập tên',
            'birthday.required'=>'Bạn chưa nhập ngày sinh',
            'superadmin.required'=>'Bạn chưa chọn quyền'
            ]
        );

        $user = User::find($id);
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->super_admin = $request->superadmin;
        $user->subject_id = $request->subjectid;
        $user->save();
        if(isset($request->clas)){
                $data = [];
                foreach ($request->clas as $key => $value) {
                    $data[] = $value;
                }
                $us = User::find($user->id);
                $us->classes()->sync($data);
            }else{
                $us = User::find($user->id);
                $us->classes()->detach();
            }
        return redirect('admin/users/danhsachnguoidung')->with('thongbao','Sửa thông tin thành công');
    }

    public function adminEdit($id)
    {
        $user = User::find($id)->toArray();
        $classes = Classes::all()->toArray();
        $sem = Semester::all()->toArray();
        $subject = Subject::all()->toArray();
        return view('page.users.editadmin',['users' => $user, 'subject'=>$subject, 'classes' => $classes, 'seme' => $sem]);
    }

    public function postAdminEdit(Request $request,$id)
    {

        $this->validate($request,[
            'name' =>'required',
            'birthday'=>'required'
            ],[
            'name.required'=>'Bạn chưa nhập tên',
            'birthday.required'=>'Bạn chưa nhập ngày sinh',
            ]
        );

        $user = User::find($id);
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->save();
        return redirect('admin/users/danhsachnguoidung')->with('thongbao','Sửa thông tin thành công');
    }

    public function userChange($id)
    {
        $user = User::find($id)->toArray();
        return view('page.users.changepw',['users' => $user]);
    }

    public function postUserChange(Request $request,$id)
    {

        $this->validate($request,[
            'password'=>'required|min:6|max:32',
            'repassword' =>'required|same:password'
            ],[
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'mật khẩu phải lớn hơn 6 ký tự',
            'password.max'=>'mật khẩu phải nhở hơn 32 ký tự',
            'repassword.same'=>'mật khẩu không trùng khớp'
            ]
        );

        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/users/danhsachnguoidung')->with('thongbao','Sửa thông tin thành công');
    }

    public function adminChange($id)
    {
        $user = User::find($id)->toArray();
        return view('page.users.changepwadmin',['users' => $user]);
    }

    public function postAdminChange(Request $request,$id)
    {

        $this->validate($request,[
            'password'=>'required|min:6|max:32',
            'repassword' =>'required|same:password'
            ],[
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'mật khẩu phải lớn hơn 6 ký tự',
            'password.max'=>'mật khẩu phải nhở hơn 32 ký tự',
            'repassword.same'=>'mật khẩu không trùng khớp'
            ]
        );

        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/users/danhsachnguoidung')->with('thongbao','Sửa thông tin thành công');
    }

    public function userBlock($id)
    {
        $actives = User::find($id);
        if ($actives->super_admin == 0 || $actives->super_admin == 1) {
            $note = 'Không thể chặn quản trị viên';
            return redirect('admin/users/danhsachnguoidung')->with('thongbao',$note);
        } else {
            $act = $actives->active;
            if ($act  == 0) {
                $actives->active  = 1;
                $note = 'chặn thành công';
            } else {
                $actives->active  = 0;
                $note = 'Bỏ chặn thành công';
            }
        }
        
        $actives->save();
        return redirect('admin/users/danhsachnguoidung')->with('thongbao',$note);
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->classes()->detach();
        $users->delete();
        return redirect('admin/users/danhsachnguoidung')->with('thongbao','Dữ liệu xóa thành công.');
    }
}
