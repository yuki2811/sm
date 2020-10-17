<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    public function classes()
    {
    	return $this->belongsToMany('App\Classes', 'class_student', 'student_id', 'class_id');
    }

    public function points()
    {
    	return $this->hasMany('App\Point');
    }
}
