<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Grade;
class SubjectController extends Controller
{
    public function getSubject()
    {
    	$grade = Grade::all()->toArray();
    	$subj = Subject::all()->toArray();
    	return view('page.subjects.subjectindex',['grade' => $grade,'subject' => $subj]);
    }

    public function addSubject()
    {
    	$grade = Grade::all()->toArray();
    	return view('page.subjects.subjectadd',['grade' => $grade]);
    }
    public function postAddSubject(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required',
            'gradeid'=>'required'
            ],[
            'name.required'=>'Bạn chưa nhập tên môn học',
            'gradeid.required'=>'Bạn chưa chọn khối học',
            ]
        );

        $subject = new Subject;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->grade_id = $request->gradeid;
        $subject->save();

        return redirect('admin/monhoc')->with('thongbao','Thêm thành công');
    }

    public function editSubject($id){
    	$subject = Subject::find($id);
    	$grade = Grade::all()->toArray();
    	$grades = Grade::find($subject->grade_id)->toArray();
    	return view('page.subjects.subjectedit',['subject'=>$subject,'grade' => $grade,'grades' => $grades]);
    }

    public function postEditSubject(Request $request, $id)
    {
    	$this->validate($request,[
            'name'=>'required',
            'gradeid'=>'required'
            ],[
            'name.required'=>'Bạn chưa nhập tên môn học',
            'gradeid.required'=>'Bạn chưa chọn khối học',
            ]
        );

        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->grade_id = $request->gradeid;
        $subject->save();

        return redirect('admin/monhoc')->with('thongbao','Sửa thành công');
    }

    public function deleteMultiple(Request $request){

        $ids = $request->ids;
        $data = explode(",",$ids);
        foreach ($data as $value) {
            $us = Subject::find($value)->classes()->detach();
        }
        Subject::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['status'=>true,'message'=>"Xóa dữ liệu thành công."]);   

    }
}
