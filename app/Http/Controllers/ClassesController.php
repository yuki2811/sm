<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Grade;
use App\Student;
use App\Semester;
use App\User;
class ClassesController extends Controller
{
    public function getClass()
    {
    	$grade = Grade::all()->toArray();
    	$sem = Semester::all()->toArray();
    	$clas = Classes::orderBy('name','asc')->get();
    	return view('page.Classes.classindex',['clas' => $clas,'grade' => $grade,'semester' => $sem]);
    }

    public function addClass()
    {
    	$grade = Grade::all()->toArray();
    	$sem = Semester::all()->toArray();
        $users = User::all()->toArray();
    	return view('page.Classes.addclass',['grade' => $grade,'semester' => $sem,'users' => $users]);
    }
    public function postAddClass(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required',
            'semesterid'=>'required',
            'gradeid'=>'required'
            ],[
            'name.required'=>'Bạn chưa nhập tên lớp',
            'semesterid.required'=>'Bạn chưa chọn kì học',
            'gradeid.required'=>'Bạn chưa chọn khối học',
            ]
        );

        $clas = new Classes;
        $clas->name = $request->name;
        $clas->grade_id = $request->gradeid;
        $clas->semester_id = $request->semesterid;
        $clas->save();
        if (isset($request->userid)) {
            $user = User::find($request->userid);
            $user->main = $clas->id;
            $user->save();
        }


        return redirect('admin/lophoc')->with('thongbao','Thêm thành công');
    }

    public function editClass($id){
    	$clas = Classes::find($id);
    	$grade = Grade::all()->toArray();
    	$sem = Semester::all()->toArray();
    	$grades = Grade::find($clas->grade_id)->toArray();
    	$semes = Semester::find($clas->semester_id)->toArray();
        $main = User::where('main', $id)->first();
        $users = User::all()->toArray();
    	return view('page.Classes.editclass',['info'=>$clas,'grade' => $grade,'semester' => $sem,'grades' => $grades,'semes' => $semes,'users' => $users,'main' => $main]);
    }

    public function postEditClass(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required',
            'semesterid'=>'required',
            'gradeid'=>'required'
            ],[
            'name.required'=>'Bạn chưa nhập tên lớp',
            'semesterid.required'=>'Bạn chưa chọn kì học',
            'gradeid.required'=>'Bạn chưa chọn khối học',
            ]
        );

        $clas = Classes::find($id);
        $clas->name = $request->name;
        $clas->grade_id = $request->gradeid;
        $clas->semester_id = $request->semesterid;
        $clas->save();
        if (isset($request->userid)) {
            $user = User::find($request->userid);
            $user->main = $clas->id;
            $user->save();
        }
        

        return redirect('admin/lophoc')->with('thongbao','Sửa thành công');
    }

    public function deleteMultiple(Request $request){

        $ids = $request->ids;
        $data = explode(",",$ids);
        foreach ($data as $value) {
            $us = Classes::find($value)->students->toArray();
            if ($us != null) {
                return response()->json(['status'=>false,'message'=>"Hãy xóa các học sinh trong lớp trước."]);
            }
        }
        foreach ($data as $value) {
            $us = Classes::find($value)->users()->detach();
        }
        Classes::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['status'=>true,'message'=>"Xóa dữ liệu thành công."]);   

    }
}
