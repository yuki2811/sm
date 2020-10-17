<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Grade;
class Classes extends Model
{
    protected $table = 'classes';

    public function semesters()
    {
    	return $this->belongsTo('App\Semester','semester_id');
    }
    public function grades()
    {
    	return $this->belongsTo('App\Grade','grade_id');
    }
    public function subjects()
    {
    	return $this->belongsToMany('App\Subject', 'class_subjects', 'class_id', 'subject_id');
    }
    public function students()
    {
        return $this->belongsToMany('App\Student', 'class_student', 'class_id', 'student_id')->orderBy('name');
    }
    public function users()
    {
        return $this->belongsToMany('App\User', 'class_user', 'class_id', 'user_id');
    }
    public function ordertb()
    {
        $users = DB::table('classes')
                ->orderBy('id', 'desc')
                ->toArray();
        return $user;
    }

}
