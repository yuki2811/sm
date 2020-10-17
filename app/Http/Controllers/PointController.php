<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use App\Classes;
use App\Subject;
use App\Grade;
use App\Student;
use App\Point;
use App\convert;
use App\destable;
use App\Exports\GradeExport;
use App\Exports\ClassExport;
use App\Exports\Point1Export;
use App\Exports\Point2Export;
use App\Exports\Point3Export;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
class PointController extends Controller
{

    public function searchPoint()
    {	
    	$sem = Semester::all()->toArray();
    	$grade = Grade::all()->toArray();
    	return view('page.points.pointsearch',['sem' => $sem,'grade' => $grade]);
    }

    public function back()
    {	
    	return redirect()->back();
    }

    public function pointIndex($semid,$subsem,$classid,$subjectid)
    {   
        $classes = Classes::find($classid)->toArray();
        $semester = Semester::find($semid)->toArray();
        $subject = Subject::find($subjectid)->toArray();
        $students = Classes::find($classid)->students->toArray();
        $subsem = $subsem;
        $data = array();
        if ($students != null) {
            foreach ($students as $value) {
                $points = Point::where('student_id', $value['id'])->where('subject_id', $subjectid)->get();

                foreach ($points as $value2) {
                    if ($value2['mieng11'] !== null) {
                        $value2['mieng11'] = Crypt::decryptString($value2['mieng11']);
                    }
                    if ($value2['mieng21'] !== null) {
                        $value2['mieng21'] = Crypt::decryptString($value2['mieng21']);
                    }
                    if ($value2['mieng31'] !== null) {
                        $value2['mieng31'] = Crypt::decryptString($value2['mieng31']);
                    }
                    if ($value2['tx11'] !== null) {
                        $value2['tx11'] = Crypt::decryptString($value2['tx11']);
                    }
                    if ($value2['tx21'] !== null) {
                        $value2['tx21'] = Crypt::decryptString($value2['tx21']);
                    }
                    if ($value2['tx31'] !== null) {
                        $value2['tx31'] = Crypt::decryptString($value2['tx31']);
                    }
                    if ($value2['tiet11'] !== null) {
                        $value2['tiet11'] = Crypt::decryptString($value2['tiet11']);
                    }
                    if ($value2['tiet21'] !== null) {
                        $value2['tiet21'] = Crypt::decryptString($value2['tiet21']);
                    }
                    if ($value2['tiet31'] !== null) {
                        $value2['tiet31'] = Crypt::decryptString($value2['tiet31']);
                    }
                    if ($value2['thi1'] !== null) {
                        $value2['thi1'] = Crypt::decryptString($value2['thi1']);
                    }
                    if ($value2['tongket1'] !== null) {
                        $value2['tongket1'] = Crypt::decryptString($value2['tongket1']);
                    }
                    if ($value2['mieng12'] !== null) {
                        $value2['mieng12'] = Crypt::decryptString($value2['mieng12']);
                    }
                    if ($value2['mieng22'] !== null) {
                        $value2['mieng22'] = Crypt::decryptString($value2['mieng22']);
                    }
                    if ($value2['mieng32'] !== null) {
                        $value2['mieng32'] = Crypt::decryptString($value2['mieng32']);
                    }
                    if ($value2['tx12'] !== null) {
                        $value2['tx12'] = Crypt::decryptString($value2['tx12']);
                    }
                    if ($value2['tx22'] !== null) {
                        $value2['tx22'] = Crypt::decryptString($value2['tx22']);
                    }
                    if ($value2['tx32'] !== null) {
                        $value2['tx32'] = Crypt::decryptString($value2['tx32']);
                    }
                    if ($value2['tiet12'] !== null) {
                        $value2['tiet12'] = Crypt::decryptString($value2['tiet12']);
                    }
                    if ($value2['tiet22'] !== null) {
                        $value2['tiet22'] = Crypt::decryptString($value2['tiet22']);
                    }
                    if ($value2['tiet32'] !== null) {
                        $value2['tiet32'] = Crypt::decryptString($value2['tiet32']);
                    }
                    if ($value2['thi2'] !== null) {
                        $value2['thi2'] = Crypt::decryptString($value2['thi2']);
                    }
                    if ($value2['tongket2'] !== null) {
                        $value2['tongket2'] = Crypt::decryptString($value2['tongket2']);
                    }
                    if ($value2['tongket'] !== null) {
                        $value2['tongket'] = Crypt::decryptString($value2['tongket']);
                    }
                    $data[] = $value2;
                }
            }
        }
        return view('page.points.pointindex2',['points' => $data,'clas' => $classes,'sem' => $semester,'sub' => $subject,'subsem' => $subsem]);
    }

    public function showClass(Request $request)
    {	
    	if ($request->ajax()) {
			$class = Classes::where('semester_id', $request->sem_id)->where('grade_id', $request->grade_id)->select('id', 'name')->get();
			$sub = Subject::where('grade_id', $request->grade_id)->orWhere('grade_id', 5)->select('id', 'name')->get();
			return response()->json($class);
		}
    }
    public function showSubject(Request $request)
    {	
    	if ($request->ajax()) {
			$sub = Subject::where('grade_id', $request->grade_id)->orWhere('grade_id', 5)->select('id', 'name')->get();
			return response()->json($sub);
		}
    }

    public function postSearchPoint(Request $request)
    {   
        $this->validate($request,[
            'grade'=>'required',
            'classes'=>'required',
            'subject'=>'required',
            'subsem'=>'required',
            ],[
            'grade.required'=>'Bạn chưa chọn năm học',
            'classes.required'=>'Bạn chưa chọn lớp học',
            'subject.required'=>'Bạn chưa chọn môn học',
            'subsem.required'=>'Bạn chưa chọn kì học',
            ]
        );
        $classes = Classes::find($request->classes)->toArray();
        $semester = Semester::find($request->semester)->toArray();
        $subject = Subject::find($request->subject)->toArray();
        $students = Classes::find($request->classes)->students->toArray();
        $subsem = $request->subsem;
        $data = array();
        if ($students != null) {
            foreach ($students as $value) {
                $points = Point::where('student_id', $value['id'])->where('subject_id', $request->subject)->get();
                $studentid = $value['id'];
                foreach ($points as $value2) {
                    if ($value2['mieng11'] !== null) {
                        $value2['mieng11'] = Crypt::decryptString($value2['mieng11']);
                    }
                    if ($value2['mieng21'] !== null) {
                        $value2['mieng21'] = Crypt::decryptString($value2['mieng21']);
                    }
                    if ($value2['mieng31'] !== null) {
                        $value2['mieng31'] = Crypt::decryptString($value2['mieng31']);
                    }
                    if ($value2['tx11'] !== null) {
                        $value2['tx11'] = Crypt::decryptString($value2['tx11']);
                    }
                    if ($value2['tx21'] !== null) {
                        $value2['tx21'] = Crypt::decryptString($value2['tx21']);
                    }
                    if ($value2['tx31'] !== null) {
                        $value2['tx31'] = Crypt::decryptString($value2['tx31']);
                    }
                    if ($value2['tiet11'] !== null) {
                        $value2['tiet11'] = Crypt::decryptString($value2['tiet11']);
                    }
                    if ($value2['tiet21'] !== null) {
                        $value2['tiet21'] = Crypt::decryptString($value2['tiet21']);
                    }
                    if ($value2['tiet31'] !== null) {
                        $value2['tiet31'] = Crypt::decryptString($value2['tiet31']);
                    }
                    if ($value2['thi1'] !== null) {
                        $value2['thi1'] = Crypt::decryptString($value2['thi1']);
                    }
                    if ($value2['tongket1'] !== null) {
                        $value2['tongket1'] = Crypt::decryptString($value2['tongket1']);
                    }
                    if ($value2['mieng12'] !== null) {
                        $value2['mieng12'] = Crypt::decryptString($value2['mieng12']);
                    }
                    if ($value2['mieng22'] !== null) {
                        $value2['mieng22'] = Crypt::decryptString($value2['mieng22']);
                    }
                    if ($value2['mieng32'] !== null) {
                        $value2['mieng32'] = Crypt::decryptString($value2['mieng32']);
                    }
                    if ($value2['tx12'] !== null) {
                        $value2['tx12'] = Crypt::decryptString($value2['tx12']);
                    }
                    if ($value2['tx22'] !== null) {
                        $value2['tx22'] = Crypt::decryptString($value2['tx22']);
                    }
                    if ($value2['tx32'] !== null) {
                        $value2['tx32'] = Crypt::decryptString($value2['tx32']);
                    }
                    if ($value2['tiet12'] !== null) {
                        $value2['tiet12'] = Crypt::decryptString($value2['tiet12']);
                    }
                    if ($value2['tiet22'] !== null) {
                        $value2['tiet22'] = Crypt::decryptString($value2['tiet22']);
                    }
                    if ($value2['tiet32'] !== null) {
                        $value2['tiet32'] = Crypt::decryptString($value2['tiet32']);
                    }
                    if ($value2['thi2'] !== null) {
                        $value2['thi2'] = Crypt::decryptString($value2['thi2']);
                    }
                    if ($value2['tongket2'] !== null) {
                        $value2['tongket2'] = Crypt::decryptString($value2['tongket2']);
                    }
                    if ($value2['tongket'] !== null) {
                        $value2['tongket'] = Crypt::decryptString($value2['tongket']);
                    }
                    $data[] = $value2;
                }
            }
        }
        return view('page.points.pointindex',['points' => $data,'clas' => $classes,'sem' => $semester,'sub' => $subject,'subsem' => $subsem]);
    }
    public function editPoints($id,$semid,$subsem,$classid,$subjectid)
    {   
        $sem = Semester::find($semid)->toArray();
        $clas = Classes::find($classid)->toArray();
        $sub = Subject::find($subjectid)->toArray();
        $subs = $subsem;
        $point = Point::find($id)->toArray();
        if ($point['mieng11'] !== null) {
            $point['mieng11'] = Crypt::decryptString($point['mieng11']);
        }
        if ($point['mieng21'] !== null) {
            $point['mieng21'] = Crypt::decryptString($point['mieng21']);
        }
        if ($point['mieng31'] !== null) {
            $point['mieng31'] = Crypt::decryptString($point['mieng31']);
        }
        if ($point['tx11'] !== null) {
            $point['tx11'] = Crypt::decryptString($point['tx11']);
        }
        if ($point['tx21'] !== null) {
            $point['tx21'] = Crypt::decryptString($point['tx21']);
        }
        if ($point['tx31'] !== null) {
            $point['tx31'] = Crypt::decryptString($point['tx31']);
        }
        if ($point['tiet11'] !== null) {
            $point['tiet11'] = Crypt::decryptString($point['tiet11']);
        }
        if ($point['tiet21'] !== null) {
            $point['tiet21'] = Crypt::decryptString($point['tiet21']);
        }
        if ($point['tiet31'] !== null) {
            $point['tiet31'] = Crypt::decryptString($point['tiet31']);
        }
        if ($point['thi1'] !== null) {
            $point['thi1'] = Crypt::decryptString($point['thi1']);
        }
        if ($point['tongket1'] !== null) {
            $point['tongket1'] = Crypt::decryptString($point['tongket1']);
        }
        if ($point['mieng12'] !== null) {
            $point['mieng12'] = Crypt::decryptString($point['mieng12']);
        }
        if ($point['mieng22'] !== null) {
            $point['mieng22'] = Crypt::decryptString($point['mieng22']);
        }
        if ($point['mieng32'] !== null) {
            $point['mieng32'] = Crypt::decryptString($point['mieng32']);
        }
        if ($point['tx12'] !== null) {
            $point['tx12'] = Crypt::decryptString($point['tx12']);
        }
        if ($point['tx22'] !== null) {
            $point['tx22'] = Crypt::decryptString($point['tx22']);
        }
        if ($point['tx32'] !== null) {
            $point['tx32'] = Crypt::decryptString($point['tx32']);
        }
        if ($point['tiet12'] !== null) {
            $point['tiet12'] = Crypt::decryptString($point['tiet12']);
        }
        if ($point['tiet22'] !== null) {
            $point['tiet22'] = Crypt::decryptString($point['tiet22']);
        }
        if ($point['tiet32'] !== null) {
            $point['tiet32'] = Crypt::decryptString($point['tiet32']);
        }
        if ($point['thi2'] !== null) {
            $point['thi2'] = Crypt::decryptString($point['thi2']);
        }
        if ($point['tongket2'] !== null) {
            $point['tongket2'] = Crypt::decryptString($point['tongket2']);
        }
        if ($point['tongket'] !== null) {
            $point['tongket'] = Crypt::decryptString($point['tongket']);
        }
        $std = Student::find($point['student_id'])->toArray();
        return view('page.points.editpoint',['points' => $point,'sem' => $sem,'subsem' => $subs,'clas' => $clas,'std' => $std,'sub' => $sub]);
    }

    public function postEditPoints(Request $request,$id,$semid,$subsem,$classid,$subjectid)
    {	    	
    	if ($subsem == 1) {
    		if ($subjectid == 15) {
	    		$point = Point::find($id);
		    	$point->mieng11 = Crypt::encryptString($request->mieng11);
		    	$point->mieng21 = Crypt::encryptString($request->mieng21);
		    	$point->mieng31 = Crypt::encryptString($request->mieng31);
		    	$point->tx11 = Crypt::encryptString($request->tx11);
		    	$point->tx21 = Crypt::encryptString($request->tx21);
		    	$point->tx31 = Crypt::encryptString($request->tx31);
		    	$point->tiet11 = Crypt::encryptString($request->tiet11);
		    	$point->tiet21 = Crypt::encryptString($request->tiet21);
		    	$point->tiet31 = Crypt::encryptString($request->tiet31);
		    	$point->thi1 = Crypt::encryptString($request->thi1);
		    	$point->tongket1 = Crypt::encryptString($request->tongket1);
		    	$point->save();
	    	} else {
	    		$point = Point::find($id);
		    	$point->mieng11 = Crypt::encryptString($request->mieng11);
                $point->mieng21 = Crypt::encryptString($request->mieng21);
                $point->mieng31 = Crypt::encryptString($request->mieng31);
                $point->tx11 = Crypt::encryptString($request->tx11);
                $point->tx21 = Crypt::encryptString($request->tx21);
                $point->tx31 = Crypt::encryptString($request->tx31);
                $point->tiet11 = Crypt::encryptString($request->tiet11);
                $point->tiet21 = Crypt::encryptString($request->tiet21);
                $point->tiet31 = Crypt::encryptString($request->tiet31);
                $point->thi1 = Crypt::encryptString($request->thi1);

		    	$tk1 = $request->tongket1;
		    	$tk2 = $request->tongket2;
		    	
		    	$point->tongket1 = Crypt::encryptString($request->tongket1);

		    	if ($tk1 != "" && $tk2 !="") {
		    		$tk = ($tk1 + 2*$tk2)/3;
		    		$final =  round($tk, 1);
		    		$final2 =  (String)$final;
		    		$point->tongket = Crypt::encryptString($final2);
		    	}
		    	$point->save();
	    	}
    	} else {
    		if ($subjectid == 15) {
	    		$point = Point::find($id);
		    	$point->mieng12 = Crypt::encryptString($request->mieng12);
		    	$point->mieng22 = Crypt::encryptString($request->mieng22);
		    	$point->mieng32 = Crypt::encryptString($request->mieng32);
		    	$point->tx12 = Crypt::encryptString($request->tx12);
		    	$point->tx22 = Crypt::encryptString($request->tx22);
		    	$point->tx32 = Crypt::encryptString($request->tx32);
		    	$point->tiet12 = Crypt::encryptString($request->tiet12);
		    	$point->tiet22 = Crypt::encryptString($request->tiet22);
		    	$point->tiet32 = Crypt::encryptString($request->tiet32);
		    	$point->thi2 = Crypt::encryptString($request->thi2);
		    	$point->tongket2 = Crypt::encryptString($request->tongket2);
		    	if ($request->tongket2 == "D") {
		    		$tongket = "D";
		    		$point->tongket = Crypt::encryptString($tongket);
		    	} else {
		    		$tongket = "CD"; 
		    		$point->tongket = Crypt::encryptString($tongket);
		    	}
		    	
		    	$point->save();
	    	} else {
	    		$point = Point::find($id);
		    	$point->mieng12 = Crypt::encryptString($request->mieng12);
                $point->mieng22 = Crypt::encryptString($request->mieng22);
                $point->mieng32 = Crypt::encryptString($request->mieng32);
                $point->tx12 = Crypt::encryptString($request->tx12);
                $point->tx22 = Crypt::encryptString($request->tx22);
                $point->tx32 = Crypt::encryptString($request->tx32);
                $point->tiet12 = Crypt::encryptString($request->tiet12);
                $point->tiet22 = Crypt::encryptString($request->tiet22);
                $point->tiet32 = Crypt::encryptString($request->tiet32);
                $point->thi2 = Crypt::encryptString($request->thi2);
		    	
		    	$tk1 = $request->tongket1;
		    	$tk2 = $request->tongket2;
		    	
		    	$point->tongket2 = Crypt::encryptString($request->tongket2);
		    	if ($tk1 != "" && $tk2 !="") {
		    		$tk = ($tk1 + 2*$tk2)/3;
		    		$final =  round($tk, 1);
		    		$final2 =  (String)$final;
		    		$point->tongket = Crypt::encryptString($final2);
		    	}
		    	$point->save();
	    	}
    	}

    	
    	return redirect()->route('dsdiem',['classid' => $classid,'semid' => $semid, 'subsem' => $subsem, 'subjectid' => $subjectid ])->with('thongbao','Sửa điểm thành công!');
    }

    public function searchInClass()
    {
        $sem = Semester::all()->toArray();
        $grade = Grade::all()->toArray();
        return view('page.points.searchinclass',['sem' => $sem,'grade' => $grade]);
    }

    public function postSearchInClass(Request $request)
    {
        $this->validate($request,[
            'grade'=>'required',
            'classes'=>'required',
            'subsem'=>'required',
            ],[
            'grade.required'=>'Bạn chưa chọn năm học',
            'classes.required'=>'Bạn chưa chọn lớp học',
            'subsem.required'=>'Bạn chưa chọn kì học',
            ]
        );
        $grade = $request->grade;
        $classes = Classes::find($request->classes)->toArray();
        $semester = Semester::find($request->semester)->toArray();
        $students = Classes::find($request->classes)->students->toArray();
        $subject2 = Subject::where('grade_id', $request->grade)->orwhere('grade_id', 5)->get();
        $subsem = $request->subsem;
        $data = array();
        $count1 = 0;
        $siso = Classes::find($request->classes)->students->count();
        foreach ($subject2 as $value2) {
                $gioi1 = 0;$kha1 = 0;$tb1 = 0;$yeu1 = 0;$kem1 = 0;$cd1 = 0;$d1 = 0;
                $data2 = array("name" => $value2['name'],"gioi" => 0,"kha" => 0,"tb" => 0,"yeu" => 0,"kem" => 0,"D" => 0,"CD" => 0);
                $data[] = $data2;
               foreach ($students as $value) {
                $points = Point::where('student_id', $value['id'])->where('subject_id', $value2['id'])->get();
                
                foreach ($points as  $value3) {
                    if ($value3['tongket1'] !== null) {
                        $value3['tongket1'] = Crypt::decryptString($value3['tongket1']);
                    }
                    if ($value3['tongket2'] !== null) {
                        $value3['tongket2'] = Crypt::decryptString($value3['tongket2']);
                    }
                    if ($value3['tongket'] !== null) {
                        $value3['tongket'] = Crypt::decryptString($value3['tongket']);
                    }
                    if ($subsem == 1) {
                        if ($value3['tongket1'] >= 8 && $value3['tongket1'] <= 10) {
                            $gioi1++;
                            $data[$count1]['gioi'] = $gioi1; 
                        }elseif ($value3['tongket1'] < 8 && $value3['tongket1'] >= 6.5) {
                            $kha1++;
                            $data[$count1]['kha'] = $kha1;
                        }elseif ($value3['tongket1'] < 6.5 && $value3['tongket1'] >= 5) {
                            $tb1++;
                            $data[$count1]['tb'] = $tb1;
                        }elseif ($value3['tongket1'] < 5 && $value3['tongket1'] >= 3.5) {
                            $yeu1++;
                            $data[$count1]['yeu'] = $yeu1;
                        }elseif ($value3['tongket1'] == "D") {
                            $d1++;
                            $data[$count1]['D'] = $d1;      
                        }elseif ($value3['tongket1'] == "CD") {
                            $cd1++;
                            $data[$count1]['CD'] = $cd1;
                        }elseif ($value3['tongket1'] < 3.5 && $value3['tongket1'] >= 0 && !is_null($value3['tongket1']) == false ) {
                            $kem1++;
                            $data[$count1]['kem'] = $kem1;
                        }
                    }elseif ($subsem == 2) {
                        if ($value3['tongket2'] >= 8 && $value3['tongket2'] <= 10) {
                            $gioi1++;
                            $data[$count1]['gioi'] = $gioi1; 
                        }elseif ($value3['tongket2'] < 8 && $value3['tongket2'] >= 6.5) {
                            $kha1++;
                            $data[$count1]['kha'] = $kha1;
                        }elseif ($value3['tongket2'] < 6.5 && $value3['tongket2'] >= 5) {
                            $tb1++;
                            $data[$count1]['tb'] = $tb1;
                        }elseif ($value3['tongket2'] < 5 && $value3['tongket2'] >= 3.5) {
                            $yeu1++;
                            $data[$count1]['yeu'] = $yeu1;
                        }elseif ($value3['tongket2'] == "D") {
                            $d1++;
                            $data[$count1]['D'] = $d1;      
                        }elseif ($value3['tongket2'] == "CD") {
                            $cd1++;
                            $data[$count1]['CD'] = $cd1;
                        }elseif ($value3    ['tongket2'] < 3.5 && $value3['tongket2'] >= 0 && !is_null($value3['tongket2']) == false ) {
                            $kem1++;
                            $data[$count1]['kem'] = $kem1;
                        }
                    }elseif($subsem == 3){
                        if ($value3['tongket'] >= 8 && $value3['tongket'] <= 10) {
                            $gioi1++;
                            $data[$count1]['gioi'] = $gioi1; 
                        }elseif ($value3['tongket'] < 8 && $value3['tongket'] >= 6.5) {
                            $kha1++;
                            $data[$count1]['kha'] = $kha1;
                        }elseif ($value3['tongket'] < 6.5 && $value3['tongket'] >= 5) {
                            $tb1++;
                            $data[$count1]['tb'] = $tb1;
                        }elseif ($value3['tongket'] < 5 && $value3['tongket'] >= 3.5) {
                            $yeu1++;
                            $data[$count1]['yeu'] = $yeu1;
                        }elseif ($value3['tongket'] == "D") {
                            $d1++;
                            $data[$count1]['D'] = $d1;      
                        }elseif ($value3['tongket'] == "CD") {
                            $cd1++;
                            $data[$count1]['CD'] = $cd1;
                        }elseif ($value3['tongket'] < 3.5 && $value3['tongket'] >= 0 && !is_null($value3['tongket']) == false ) {
                            $kem1++;
                            $data[$count1]['kem'] = $kem1;
                        }
                    }
                }             
            }
            $count1++;
           }  
        return view('page.points.inclassindex',['points' => $data,'grade' => $grade,'siso' => $siso,'clas' => $classes,'sem' => $semester,'subsem' => $subsem]);
    }

    public function searchInGrade()
    {
        $sem = Semester::all()->toArray();
        return view('page.points.searchingrade',['sem' => $sem]);
    }
    public function postSearchInGrade(Request $request)
    {
        $this->validate($request,[
            'subsem'=>'required',
            'grade'=>'required',
            ],[
            'subsem.required'=>'Bạn chưa chọn kì học',
            'grade.required'=>'Bạn chưa chọn khối học',
            ]
        );
        $grade = Grade::find($request->grade)->toArray();
        $classes = Classes::where('semester_id', $request->semester)->where('grade_id', $request->grade)->get();
        $semester = Semester::find($request->semester)->toArray();
        $subject2 = Subject::where('grade_id', $request->grade)->orwhere('grade_id', 5)->get();
        $subsem = $request->subsem;
        $data = array();
        $count1 = 0;
        $siso = 0;
        foreach ($classes as $value4) {
            $siso1 = Classes::find($value4['id'])->students->count();
                $siso+=$siso1;
        }
        foreach ($subject2 as $value2) {
                $gioi1 = 0;$kha1 = 0;$tb1 = 0;$yeu1 = 0;$kem1 = 0;$cd1 = 0;$d1 = 0;
                $data2 = array("name" => $value2['name'],"gioi" => 0,"kha" => 0,"tb" => 0,"yeu" => 0,"kem" => 0,"D" => 0,"CD" => 0);
                $data[] = $data2;
                foreach ($classes as $value4) {
                $students = Classes::find($value4['id'])->students->toArray();
                    foreach ($students as $value) {
                        $points = Point::where('student_id', $value['id'])->where('subject_id', $value2['id'])->get();
                
                            foreach ($points as  $value3) {
                                if ($value3['tongket1'] !== null) {
                                    $value3['tongket1'] = Crypt::decryptString($value3['tongket1']);
                                }
                                if ($value3['tongket2'] !== null) {
                                    $value3['tongket2'] = Crypt::decryptString($value3['tongket2']);
                                }
                                if ($value3['tongket'] !== null) {
                                    $value3['tongket'] = Crypt::decryptString($value3['tongket']);
                                }
                                if ($subsem == 1) {
                                    if ($value3['tongket1'] >= 8 && $value3['tongket1'] <= 10) {
                                        $gioi1++;
                                        $data[$count1]['gioi'] = $gioi1; 
                                    }elseif ($value3['tongket1'] < 8 && $value3['tongket1'] >= 6.5) {
                                        $kha1++;
                                        $data[$count1]['kha'] = $kha1;
                                    }elseif ($value3['tongket1'] < 6.5 && $value3['tongket1'] >= 5) {
                                        $tb1++;
                                        $data[$count1]['tb'] = $tb1;
                                    }elseif ($value3['tongket1'] < 5 && $value3['tongket1'] >= 3.5) {
                                        $yeu1++;
                                        $data[$count1]['yeu'] = $yeu1;
                                    }elseif ($value3['tongket1'] == "D") {
                                        $d1++;
                                        $data[$count1]['D'] = $d1;      
                                    }elseif ($value3['tongket1'] == "CD") {
                                        $cd1++;
                                        $data[$count1]['CD'] = $cd1;
                                    }elseif ($value3['tongket1'] < 3.5 && $value3['tongket1'] >= 0 && !is_null($value3['tongket1']) == false ) {
                                        $kem1++;
                                        $data[$count1]['kem'] = $kem1;
                                    }
                                }elseif ($subsem == 2) {
                                    if ($value3['tongket2'] >= 8 && $value3['tongket2'] <= 10) {
                                        $gioi1++;
                                        $data[$count1]['gioi'] = $gioi1; 
                                    }elseif ($value3['tongket2'] < 8 && $value3['tongket2'] >= 6.5) {
                                        $kha1++;
                                        $data[$count1]['kha'] = $kha1;
                                    }elseif ($value3['tongket2'] < 6.5 && $value3['tongket2'] >= 5) {
                                        $tb1++;
                                        $data[$count1]['tb'] = $tb1;
                                    }elseif ($value3['tongket2'] < 5 && $value3['tongket2'] >= 3.5) {
                                        $yeu1++;
                                        $data[$count1]['yeu'] = $yeu1;
                                    }elseif ($value3['tongket2'] == "D") {
                                        $d1++;
                                        $data[$count1]['D'] = $d1;      
                                    }elseif ($value3['tongket2'] == "CD") {
                                        $cd1++;
                                        $data[$count1]['CD'] = $cd1;
                                    }elseif ($value3    ['tongket2'] < 3.5 && $value3['tongket2'] >= 0 && !is_null($value3['tongket2']) == false ) {
                                        $kem1++;
                                        $data[$count1]['kem'] = $kem1;
                                    }
                                }elseif($subsem == 3){
                                    if ($value3['tongket'] >= 8 && $value3['tongket'] <= 10) {
                                        $gioi1++;
                                        $data[$count1]['gioi'] = $gioi1; 
                                    }elseif ($value3['tongket'] < 8 && $value3['tongket'] >= 6.5) {
                                        $kha1++;
                                        $data[$count1]['kha'] = $kha1;
                                    }elseif ($value3['tongket'] < 6.5 && $value3['tongket'] >= 5) {
                                        $tb1++;
                                        $data[$count1]['tb'] = $tb1;
                                    }elseif ($value3['tongket'] < 5 && $value3['tongket'] >= 3.5) {
                                        $yeu1++;
                                        $data[$count1]['yeu'] = $yeu1;
                                    }elseif ($value3['tongket'] == "D") {
                                        $d1++;
                                        $data[$count1]['D'] = $d1;      
                                    }elseif ($value3['tongket'] == "CD") {
                                        $cd1++;
                                        $data[$count1]['CD'] = $cd1;
                                    }elseif ($value3['tongket'] < 3.5 && $value3['tongket'] >= 0 && !is_null($value3['tongket']) == false ) {
                                        $kem1++;
                                        $data[$count1]['kem'] = $kem1;
                                    }
                                }
                            }             
                        }
                }
            $count1++;
           }
        return view('page.points.ingradeindex',['points' => $data,'siso' => $siso,'grade' => $grade,'sem' => $semester,'subsem' => $subsem]);
    }

    public function gradeExport($sems,$grades,$subsems)
    {
        $grade = Grade::find($grades)->toArray();
        $classes = Classes::where('semester_id', $sems)->where('grade_id', $grades)->get();
        $semester = Semester::find($sems)->toArray();
        $subject2 = Subject::where('grade_id', $grades)->orwhere('grade_id', 5)->get();
        $subsem = $subsems;
        $data = array();
        $count1 = 0;
        $siso = 0;
        foreach ($classes as $value4) {
            $siso1 = Classes::find($value4['id'])->students->count();
                $siso+=$siso1;
        }
        foreach ($subject2 as $value2) {
                $gioi1 = 0;$kha1 = 0;$tb1 = 0;$yeu1 = 0;$kem1 = 0;$cd1 = 0;$d1 = 0;
                $data2 = array("name" => $value2['name'],"gioi" => 0,"kha" => 0,"tb" => 0,"yeu" => 0,"kem" => 0,"D" => 0,"CD" => 0);
                $data[] = $data2;
                foreach ($classes as $value4) {
                $students = Classes::find($value4['id'])->students->toArray();
                    foreach ($students as $value) {
                        $points = Point::where('student_id', $value['id'])->where('subject_id', $value2['id'])->get();
                
                            foreach ($points as  $value3) {
                                if ($value3['tongket1'] !== null) {
                                    $value3['tongket1'] = Crypt::decryptString($value3['tongket1']);
                                }
                                if ($value3['tongket2'] !== null) {
                                    $value3['tongket2'] = Crypt::decryptString($value3['tongket2']);
                                }
                                if ($value3['tongket'] !== null) {
                                    $value3['tongket'] = Crypt::decryptString($value3['tongket']);
                                }
                                if ($subsem == 1) {
                                    if ($value3['tongket1'] >= 8 && $value3['tongket1'] <= 10) {
                                        $gioi1++;
                                        $data[$count1]['gioi'] = $gioi1; 
                                    }elseif ($value3['tongket1'] < 8 && $value3['tongket1'] >= 6.5) {
                                        $kha1++;
                                        $data[$count1]['kha'] = $kha1;
                                    }elseif ($value3['tongket1'] < 6.5 && $value3['tongket1'] >= 5) {
                                        $tb1++;
                                        $data[$count1]['tb'] = $tb1;
                                    }elseif ($value3['tongket1'] < 5 && $value3['tongket1'] >= 3.5) {
                                        $yeu1++;
                                        $data[$count1]['yeu'] = $yeu1;
                                    }elseif ($value3['tongket1'] == "D") {
                                        $d1++;
                                        $data[$count1]['D'] = $d1;      
                                    }elseif ($value3['tongket1'] == "CD") {
                                        $cd1++;
                                        $data[$count1]['CD'] = $cd1;
                                    }elseif ($value3['tongket1'] < 3.5 && $value3['tongket1'] >= 0 && !is_null($value3['tongket1']) == false ) {
                                        $kem1++;
                                        $data[$count1]['kem'] = $kem1;
                                    }
                                }elseif ($subsem == 2) {
                                    if ($value3['tongket2'] >= 8 && $value3['tongket2'] <= 10) {
                                        $gioi1++;
                                        $data[$count1]['gioi'] = $gioi1; 
                                    }elseif ($value3['tongket2'] < 8 && $value3['tongket2'] >= 6.5) {
                                        $kha1++;
                                        $data[$count1]['kha'] = $kha1;
                                    }elseif ($value3['tongket2'] < 6.5 && $value3['tongket2'] >= 5) {
                                        $tb1++;
                                        $data[$count1]['tb'] = $tb1;
                                    }elseif ($value3['tongket2'] < 5 && $value3['tongket2'] >= 3.5) {
                                        $yeu1++;
                                        $data[$count1]['yeu'] = $yeu1;
                                    }elseif ($value3['tongket2'] == "D") {
                                        $d1++;
                                        $data[$count1]['D'] = $d1;      
                                    }elseif ($value3['tongket2'] == "CD") {
                                        $cd1++;
                                        $data[$count1]['CD'] = $cd1;
                                    }elseif ($value3    ['tongket2'] < 3.5 && $value3['tongket2'] >= 0 && !is_null($value3['tongket2']) == false ) {
                                        $kem1++;
                                        $data[$count1]['kem'] = $kem1;
                                    }
                                }elseif($subsem == 3){
                                    if ($value3['tongket'] >= 8 && $value3['tongket'] <= 10) {
                                        $gioi1++;
                                        $data[$count1]['gioi'] = $gioi1; 
                                    }elseif ($value3['tongket'] < 8 && $value3['tongket'] >= 6.5) {
                                        $kha1++;
                                        $data[$count1]['kha'] = $kha1;
                                    }elseif ($value3['tongket'] < 6.5 && $value3['tongket'] >= 5) {
                                        $tb1++;
                                        $data[$count1]['tb'] = $tb1;
                                    }elseif ($value3['tongket'] < 5 && $value3['tongket'] >= 3.5) {
                                        $yeu1++;
                                        $data[$count1]['yeu'] = $yeu1;
                                    }elseif ($value3['tongket'] == "D") {
                                        $d1++;
                                        $data[$count1]['D'] = $d1;      
                                    }elseif ($value3['tongket'] == "CD") {
                                        $cd1++;
                                        $data[$count1]['CD'] = $cd1;
                                    }elseif ($value3['tongket'] < 3.5 && $value3['tongket'] >= 0 && !is_null($value3['tongket']) == false ) {
                                        $kem1++;
                                        $data[$count1]['kem'] = $kem1;
                                    }
                                }
                            }             
                        }
                }
            $count1++;
           }
        return Excel::download(new GradeExport($data,$siso,$grade,$semester,$subsem), 'thongkekhoi.xlsx');
    }
    public function classExport($sems,$classess,$grades,$subsems)
    {
        $classes = Classes::find($classess)->toArray();
        $semester = Semester::find($sems)->toArray();
        $students = Classes::find($classess)->students->toArray();
        $subject2 = Subject::where('grade_id', $grades)->orwhere('grade_id', 5)->get();
        $subsem = $subsems;
        $data = array();
        $count1 = 0;
        $siso = Classes::find($classess)->students->count();
        foreach ($subject2 as $value2) {
                $gioi1 = 0;$kha1 = 0;$tb1 = 0;$yeu1 = 0;$kem1 = 0;$cd1 = 0;$d1 = 0;
                $data2 = array("name" => $value2['name'],"gioi" => 0,"kha" => 0,"tb" => 0,"yeu" => 0,"kem" => 0,"D" => 0,"CD" => 0);
                $data[] = $data2;
               foreach ($students as $value) {
                $points = Point::where('student_id', $value['id'])->where('subject_id', $value2['id'])->get();
                
                foreach ($points as  $value3) {
                    if ($value3['tongket1'] !== null) {
                        $value3['tongket1'] = Crypt::decryptString($value3['tongket1']);
                    }
                    if ($value3['tongket2'] !== null) {
                        $value3['tongket2'] = Crypt::decryptString($value3['tongket2']);
                    }
                    if ($value3['tongket'] !== null) {
                        $value3['tongket'] = Crypt::decryptString($value3['tongket']);
                    }
                    if ($subsem == 1) {
                        if ($value3['tongket1'] >= 8 && $value3['tongket1'] <= 10) {
                            $gioi1++;
                            $data[$count1]['gioi'] = $gioi1; 
                        }elseif ($value3['tongket1'] < 8 && $value3['tongket1'] >= 6.5) {
                            $kha1++;
                            $data[$count1]['kha'] = $kha1;
                        }elseif ($value3['tongket1'] < 6.5 && $value3['tongket1'] >= 5) {
                            $tb1++;
                            $data[$count1]['tb'] = $tb1;
                        }elseif ($value3['tongket1'] < 5 && $value3['tongket1'] >= 3.5) {
                            $yeu1++;
                            $data[$count1]['yeu'] = $yeu1;
                        }elseif ($value3['tongket1'] == "D") {
                            $d1++;
                            $data[$count1]['D'] = $d1;      
                        }elseif ($value3['tongket1'] == "CD") {
                            $cd1++;
                            $data[$count1]['CD'] = $cd1;
                        }elseif ($value3['tongket1'] < 3.5 && $value3['tongket1'] >= 0 && !is_null($value3['tongket1']) == false ) {
                            $kem1++;
                            $data[$count1]['kem'] = $kem1;
                        }
                    }elseif ($subsem == 2) {
                        if ($value3['tongket2'] >= 8 && $value3['tongket2'] <= 10) {
                            $gioi1++;
                            $data[$count1]['gioi'] = $gioi1; 
                        }elseif ($value3['tongket2'] < 8 && $value3['tongket2'] >= 6.5) {
                            $kha1++;
                            $data[$count1]['kha'] = $kha1;
                        }elseif ($value3['tongket2'] < 6.5 && $value3['tongket2'] >= 5) {
                            $tb1++;
                            $data[$count1]['tb'] = $tb1;
                        }elseif ($value3['tongket2'] < 5 && $value3['tongket2'] >= 3.5) {
                            $yeu1++;
                            $data[$count1]['yeu'] = $yeu1;
                        }elseif ($value3['tongket2'] == "D") {
                            $d1++;
                            $data[$count1]['D'] = $d1;      
                        }elseif ($value3['tongket2'] == "CD") {
                            $cd1++;
                            $data[$count1]['CD'] = $cd1;
                        }elseif ($value3    ['tongket2'] < 3.5 && $value3['tongket2'] >= 0 && !is_null($value3['tongket2']) == false ) {
                            $kem1++;
                            $data[$count1]['kem'] = $kem1;
                        }
                    }elseif($subsem == 3){
                        if ($value3['tongket'] >= 8 && $value3['tongket'] <= 10) {
                            $gioi1++;
                            $data[$count1]['gioi'] = $gioi1; 
                        }elseif ($value3['tongket'] < 8 && $value3['tongket'] >= 6.5) {
                            $kha1++;
                            $data[$count1]['kha'] = $kha1;
                        }elseif ($value3['tongket'] < 6.5 && $value3['tongket'] >= 5) {
                            $tb1++;
                            $data[$count1]['tb'] = $tb1;
                        }elseif ($value3['tongket'] < 5 && $value3['tongket'] >= 3.5) {
                            $yeu1++;
                            $data[$count1]['yeu'] = $yeu1;
                        }elseif ($value3['tongket'] == "D") {
                            $d1++;
                            $data[$count1]['D'] = $d1;      
                        }elseif ($value3['tongket'] == "CD") {
                            $cd1++;
                            $data[$count1]['CD'] = $cd1;
                        }elseif ($value3['tongket'] < 3.5 && $value3['tongket'] >= 0 && !is_null($value3['tongket']) == false ) {
                            $kem1++;
                            $data[$count1]['kem'] = $kem1;
                        }
                    }
                }             
            }
            $count1++;
           }
        return Excel::download(new ClassExport($data,$siso,$classes,$semester,$subsem), 'thongkelop.xlsx');
    }
    public function pointExport($sems,$classess,$grades,$subsems,$subjects)
    {
        $classes = Classes::find($classess)->toArray();
        $semester = Semester::find($sems)->toArray();
        $subject = Subject::find($subjects)->toArray();
        $students = Classes::find($classess)->students->toArray();
        $subsem = $subsems;
        $data = array();
        if ($students != null) {
            foreach ($students as $value) {
                $points = Point::where('student_id', $value['id'])->where('subject_id', $subjects)->get();
                $studentid = $value['id'];
                foreach ($points as  $value2) {
                    if ($value2['mieng11'] !== null) {
                        $value2['mieng11'] = Crypt::decryptString($value2['mieng11']);
                    }
                    if ($value2['mieng21'] !== null) {
                        $value2['mieng21'] = Crypt::decryptString($value2['mieng21']);
                    }
                    if ($value2['mieng31'] !== null) {
                        $value2['mieng31'] = Crypt::decryptString($value2['mieng31']);
                    }
                    if ($value2['tx11'] !== null) {
                        $value2['tx11'] = Crypt::decryptString($value2['tx11']);
                    }
                    if ($value2['tx21'] !== null) {
                        $value2['tx21'] = Crypt::decryptString($value2['tx21']);
                    }
                    if ($value2['tx31'] !== null) {
                        $value2['tx31'] = Crypt::decryptString($value2['tx31']);
                    }
                    if ($value2['tiet11'] !== null) {
                        $value2['tiet11'] = Crypt::decryptString($value2['tiet11']);
                    }
                    if ($value2['tiet21'] !== null) {
                        $value2['tiet21'] = Crypt::decryptString($value2['tiet21']);
                    }
                    if ($value2['tiet31'] !== null) {
                        $value2['tiet31'] = Crypt::decryptString($value2['tiet31']);
                    }
                    if ($value2['thi1'] !== null) {
                        $value2['thi1'] = Crypt::decryptString($value2['thi1']);
                    }
                    if ($value2['tongket1'] !== null) {
                        $value2['tongket1'] = Crypt::decryptString($value2['tongket1']);
                    }
                    if ($value2['mieng12'] !== null) {
                        $value2['mieng12'] = Crypt::decryptString($value2['mieng12']);
                    }
                    if ($value2['mieng22'] !== null) {
                        $value2['mieng22'] = Crypt::decryptString($value2['mieng22']);
                    }
                    if ($value2['mieng32'] !== null) {
                        $value2['mieng32'] = Crypt::decryptString($value2['mieng32']);
                    }
                    if ($value2['tx12'] !== null) {
                        $value2['tx12'] = Crypt::decryptString($value2['tx12']);
                    }
                    if ($value2['tx22'] !== null) {
                        $value2['tx22'] = Crypt::decryptString($value2['tx22']);
                    }
                    if ($value2['tx32'] !== null) {
                        $value2['tx32'] = Crypt::decryptString($value2['tx32']);
                    }
                    if ($value2['tiet12'] !== null) {
                        $value2['tiet12'] = Crypt::decryptString($value2['tiet12']);
                    }
                    if ($value2['tiet22'] !== null) {
                        $value2['tiet22'] = Crypt::decryptString($value2['tiet22']);
                    }
                    if ($value2['tiet32'] !== null) {
                        $value2['tiet32'] = Crypt::decryptString($value2['tiet32']);
                    }
                    if ($value2['thi2'] !== null) {
                        $value2['thi2'] = Crypt::decryptString($value2['thi2']);
                    }
                    if ($value2['tongket2'] !== null) {
                        $value2['tongket2'] = Crypt::decryptString($value2['tongket2']);
                    }
                    if ($value2['tongket'] !== null) {
                        $value2['tongket'] = Crypt::decryptString($value2['tongket']);
                    }
                    $data[] = $value2;

                }
            }
        }
        if ($subsem == 1) {
            return Excel::download(new point1Export($data,$classes,$semester,$subject,$subsem), 'diemhk1.xlsx');
        }elseif ($subsem == 2) {
            return Excel::download(new point2Export($data,$classes,$semester,$subject,$subsem), 'diemhk2.xlsx');
        }else{
            return Excel::download(new point3Export($data,$classes,$semester,$subject,$subsem), 'diemcanam.xlsx');
        }
    }
}
