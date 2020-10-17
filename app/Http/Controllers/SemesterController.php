<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Semester;
use App\Classes;

class SemesterController extends Controller
{
    public function getSemester()
    {
    	$sem = Semester::all()->toArray();
    	return view('page.Classes.semesterindex',['sem' => $sem]);
    }
    public function addSemester()
    {
    	return view('page.Classes.addsemester');
    }
    public function postAddSemester(Request $request)
    {
    	$this->validate($request,[
            'start_year'=>'required',
            ],[
            'start_year.required'=>'Bạn chưa nhập tên kì học',
            ]
        );
        $syear = $request->start_year;
        $endyear = $syear + 1;
        $sem = new Semester;
        $sem->start_year = $request->start_year;
        $sem->end_year = $endyear;
        $sem->description = $request->description;
        $sem->save();

        return redirect('admin/kihoc')->with('thongbao','Thêm thành công');
    }

    public function editSemester($id){
    	$sem = Semester::find($id);
    	return view('page.Classes.editsemester',['info'=>$sem]);
    }

    public function postEditSemester(Request $request,$id)
    {
    	$this->validate($request,[
            'start_year'=>'required',
            ],[
            'start_year.required'=>'Bạn chưa nhập tên kì học',
            ]
        );

        $syear = $request->start_year;
        $endyear = $syear + 1;
        $sem = Semester::find($id);
        $sem->start_year = $request->start_year;
        $sem->end_year = $endyear;
        $sem->description = $request->description;
        $sem->save();

        return redirect('admin/kihoc')->with('thongbao','Sửa thành công');
    }

    public function deleteMultiple(Request $request){

        $ids = $request->ids;
        $data = explode(",",$ids);
        foreach ($data as $value) {
            $us = DB::table('classes')->where('semester_id', $value)->count();
            if ($us > 0) {
                return response()->json(['status'=>false,'message'=>"Hãy xóa các lớp thuộc năm học này trước."]);
            }
        }

        Semester::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['status'=>true,'message'=>"Xóa dữ liệu thành công."]);   

    }
}
