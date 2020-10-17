<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Student;
use App\Semester;
use App\Subject;
use App\Point;
use App\User;
use App\Exports\StatusExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
class StudentController extends Controller
{
    public function getStudent($id,$gradeid)
    {	

    	$clas = Classes::find($id)->toArray(); 

        $grade = $gradeid;
    	$sem = Semester::find($clas['semester_id'])->toArray();
    	$student = Classes::find($id)->students->toArray();
        $data = array();
        foreach ($student as $value) {
            $value['first_name'] = Crypt::decryptString($value['first_name']);
            $value['name'] = Crypt::decryptString($value['name']);
            $value['sex'] = Crypt::decryptString($value['sex']);
            $value['birthday'] = Crypt::decryptString($value['birthday']);
            if ($value['status'] != null) {
                $value['status'] = Crypt::decryptString($value['status']);
            }
            $value['birthplace'] = Crypt::decryptString($value['birthplace']);
            $data[] = $value;
        }
        $main = User::where('main', $id)->first();
    	return view('page.students.studentindex',['student' => $data,'main' => $main,'clas' => $clas,'sem' => $sem,'gradeid' => $gradeid]);
    }


    public function addStudent($classid,$gradeid)
    {
    	$clas = Classes::find($classid)->toArray();
    	$sem = Semester::find($clas['semester_id'])->toArray();
        $grade = $gradeid;
    	return view('page.students.addstudent',['clas' => $clas,'sem' => $sem,'gradeid' => $gradeid]);
    }
    public function postAddStudent(Request $request,$classid,$gradeid)
    {
    	$this->validate($request,[
            'firstname'=>'required',
            'name'=>'required',
            'birthday'=>'required',
            'sex'=>'required',
            'birthplace'=>'required',
            ],[
            'firstname.required'=>'Bạn chưa nhập họ học sinh',
            'name.required'=>'Bạn chưa nhập tên học sinh',
            'birthday.required'=>'Bạn chưa chọn ngày sinh',
            'sex.required'=>'Bạn chưa chọn giới tính',
            'birthplace.required'=>'Bạn chưa nhập quê quán',
            ]
        );

        $student = new Student;
        $student->first_name = Crypt::encryptString($request->firstname);
        $student->name = Crypt::encryptString($request->name);
        $student->birthday = Crypt::encryptString($request->birthday);
        $student->sex = Crypt::encryptString($request->sex);
        $student->birthplace = Crypt::encryptString($request->birthplace);
        $student->save();
        $clas = Student::find($student->id);
		$clas->classes()->sync($classid);
        $subject = Subject::where('grade_id', 5)->orWhere('grade_id', $gradeid)->get();
        foreach ($subject as $value) {
            $point = new Point;
            $point->student_id = $student->id;
            $point->subject_id = $value['id'];
            $point->save();
        }
        return redirect('admin/hocsinh/'.$classid.'/'.$gradeid.'')->with('thongbao','Thêm thành công');
    }

    public function editStudent($id,$classid,$gradeid){
        $grade = $gradeid;
    	$clas = Classes::find($classid)->toArray();
    	$sem = Semester::find($clas['semester_id'])->toArray();
    	$student = Student::where('id', $id)->get();
        $data = array();
        foreach ($student as $value) {
            $value['first_name'] = Crypt::decryptString($value['first_name']);
            $value['name'] = Crypt::decryptString($value['name']);
            $value['sex'] = Crypt::decryptString($value['sex']);
            $value['birthday'] = Crypt::decryptString($value['birthday']);
            if ($value['status'] != null) {
                $value['status'] = Crypt::decryptString($value['status']);
            }
            $value['birthplace'] = Crypt::decryptString($value['birthplace']);
            $data[] = $value;
        }
    	return view('page.students.editstudent',['info'=>$data,'clas' => $clas,'sem' => $sem,'gradeid' => $grade]);
    }

    public function postEditStudent(Request $request,$classid,$gradeid)
    {
    	$this->validate($request,[
            'firstname'=>'required',
            'name'=>'required',
            'birthday'=>'required',
            'sex'=>'required',
            'birthplace'=>'required',
            ],[
            'firstname.required'=>'Bạn chưa nhập tên học sinh',
            'name.required'=>'Bạn chưa nhập tên học sinh',
            'birthday.required'=>'Bạn chưa chọn ngày sinh',
            'sex.required'=>'Bạn chưa chọn giới tính',
            'birthplace.required'=>'Bạn chưa nhập quê quán',
            ]
        );
        $grade = $gradeid;
        $student = Student::find($request->idstudent);
        $student->first_name = Crypt::encryptString($request->firstname);
        $student->name = Crypt::encryptString($request->name);
        $student->birthday = Crypt::encryptString($request->birthday);
        $student->sex = Crypt::encryptString($request->sex);
        $student->birthplace = Crypt::encryptString($request->birthplace);
        $student->status = Crypt::encryptString($request->status);
        $student->save();

        return redirect('admin/hocsinh/'.$classid.'/'.$gradeid.'')->with('thongbao','Sửa thành công');
    }

    public function deleteMultiple(Request $request){
    	$idClasses = $request->idClasses;
        $ids = $request->ids;
		$data = explode(",",$ids);
		foreach ($data as $value) {
			$us = Student::find($value);
			$us->classes()->detach($idClasses);
            $us->delete();
            $point = Point::where('student_id', $value)->delete();
    			}	
        return response()->json(['status'=>true,'message'=>"Xóa dữ liệu thành công."]);   

    }

    public function statusExport($classid,$gradeid)
    {   
        $clas = Classes::find($classid)->toArray(); 
        $sem = Semester::find($clas['semester_id'])->toArray();
        $student = Classes::find($classid)->students->toArray();
        $data = array();
        foreach ($student as $value) {
            $value['first_name'] = Crypt::decryptString($value['first_name']);
            $value['name'] = Crypt::decryptString($value['name']);
            $value['sex'] = Crypt::decryptString($value['sex']);
            $value['birthday'] = Crypt::decryptString($value['birthday']);
            if ($value['status'] != null) {
                $value['status'] = Crypt::decryptString($value['status']);
            }
            $value['birthplace'] = Crypt::decryptString($value['birthplace']);
            $data[] = $value;
        }
        return Excel::download(new StatusExport($data,$clas,$sem), 'danhsachhocsinh.xlsx');
    }
}
