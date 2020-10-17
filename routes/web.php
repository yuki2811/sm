<?php

use Illuminate\Support\Facades\Route;
use App\Semester;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function(){
		if(Auth::check())
        {   
            return redirect('trangchu');
        }else{
            return redirect('login');
        }
	});

Route::get('login','LoginController@getLogin');
Route::post('loginn','LoginController@postLogin');
Route::post('logout','LoginController@outLogin')->name('admin.logout');
Route::get('trangchu','UserController@getUser')->middleware('adminLogin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	//Semester
	Route::get('kihoc','SemesterController@getSemester')->middleware('setting');
	Route::get('themkihoc','SemesterController@addSemester')->middleware('setting');
	Route::post('themkihoc','SemesterController@postAddSemester')->middleware('setting');
	Route::get('suakihoc/{id}','SemesterController@editSemester')->middleware('setting');
	Route::post('suakihoc/{id}','SemesterController@postEditSemester')->middleware('setting');
	Route::delete('delete-multiple-semester', ['as'=>'semester.multiple-delete','uses'=>'SemesterController@deleteMultiple'])->middleware('setting');
	//Class
	Route::get('lophoc','ClassesController@getClass');
	Route::get('themlophoc','ClassesController@addClass')->middleware('setting');
	Route::post('themlophoc','ClassesController@postAddClass')->middleware('setting');
	Route::get('sualophoc/{id}','ClassesController@editClass')->middleware('setting');
	Route::post('sualophoc/{id}','ClassesController@postEditClass')->middleware('setting');
	Route::delete('delete-multiple-class', ['as'=>'class.multiple-delete','uses'=>'ClassesController@deleteMultiple'])->middleware('setting');
	//Student
	Route::get('hocsinh/{id}/{gradeid}','StudentController@getStudent');
	Route::get('themhocsinh/{classid}/{gradeid}','StudentController@addStudent')->name('themhs')->middleware('main');
	Route::post('themhocsinh/{classid}/{gradeid}','StudentController@postAddStudent')->name('addhs')->middleware('main');
	Route::get('suahocsinh/{id}/{classid}/{gradeid}','StudentController@editStudent')->name('suahocsinh')->middleware('main');
	Route::post('suahocsinh/{classid}/{gradeid}','StudentController@postEditStudent')->name('edithocsinh')->middleware('main');
	Route::delete('delete-multiple-student', ['as'=>'student.multiple-delete','uses'=>'StudentController@deleteMultiple'])->middleware('setting');
		Route::get('xuathanhkiem/{classid}/{gradeid}','StudentController@statusExport')->name('admin.statusexport');
	//subject
	Route::get('monhoc','SubjectController@getSubject')->middleware('setting');
	Route::get('themmonhoc','SubjectController@addSubject')->middleware('setting');
	Route::post('themmonhoc','SubjectController@postAddSubject')->middleware('setting');
	Route::get('suamonhoc/{id}','SubjectController@editSubject')->middleware('setting');
	Route::post('suamonhoc/{id}','SubjectController@postEditSubject')->middleware('setting');
	Route::delete('delete-multiple-subject', ['as'=>'subject.multiple-delete','uses'=>'SubjectController@deleteMultiple'])->middleware('setting');


	//Point
	Route::get('diem','PointController@searchPoint');
	Route::get('quaylai','PointController@back');
	Route::get('danhsachdiem{semid}/{subsem}/{classid}/{subjectid}.html','PointController@pointIndex')->name('dsdiem');
	Route::post('showlophoc','PointController@showClass');
	Route::post('showmonhoc','PointController@showSubject');
	Route::post('diem','PointController@postSearchPoint')->name('pointsindex');	
	Route::get('suadiem{id}/{semid}/{subsem}/{classid}/{subjectid}.html','PointController@editPoints')->name('editpoint')->middleware('checkPer');
	Route::post('suadiemhoc{id}/{semid}/{subsem}/{classid}/{subjectid}','PointController@postEditPoints')->name('editpoints')->middleware('checkPer');
	//Thongke
	Route::get('thongkelop','PointController@searchInClass');
	Route::post('thongkelop','PointController@postSearchInClass');
	Route::get('thongkekhoi','PointController@searchInGrade');
	Route::post('thongkekhoi','PointController@postSearchInGrade');
	Route::get('xuatgrade/{sems}/{grades}/{subsems}','PointController@gradeExport')->name('admin.gradeexport');
	Route::get('xuatclass/{sems}/{classess}/{grades}/{subsems}','PointController@classExport')->name('admin.classexport');
	Route::get('xuatdiem/{sems}/{classess}/{grades}/{subsems}/{subjects}','PointController@pointExport')->name('admin.pointexport');


	Route::group(['prefix'=>'users'],function(){
		Route::get('danhsachnguoidung','UserController@userIndex')->middleware('setting');
		Route::get('themnguoidung','UserController@userAdd')->middleware('setting');
		Route::post('themnguoidung','UserController@postUserAdd')->middleware('setting');
		Route::get('suanguoidung/{id}','UserController@userEdit')->middleware('setting');
		Route::post('suanguoidung/{id}','UserController@postUserEdit')->middleware('setting');
		Route::get('suaadmin/{id}','UserController@adminEdit')->middleware('settingAdmin');
		Route::post('suaadmin/{id}','UserController@postAdminEdit')->middleware('settingAdmin');
		Route::get('channguoidung/{id}','UserController@userBlock')->middleware('setting');
		Route::delete('xoanguoidung/{id}','UserController@destroy')->name('destroyuser')->middleware('setting');
		Route::get('doimatkhau/{id}','UserController@userChange')->name('changepw')->middleware('setting');
		Route::post('doimatkhau/{id}','UserController@postUserChange')->middleware('setting');
		Route::get('doimatkhauad/{id}','UserController@adminChange')->name('changepwadmin')->middleware('settingAdmin');
		Route::post('doimatkhauad/{id}','UserController@postAdminChange')->middleware('settingAdmin');
	});
});



View::composer('*', function($view)
{
	$info = Auth::user();
    $view->with('userLogin', $info);
});

