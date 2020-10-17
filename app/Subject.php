<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    public function classes()
    {
    	return $this->belongsToMany('App\Classes', 'class_subjects', 'class_id', 'subject_id');
    }

    public function grades()
    {
    	return $this->belongsTo('App\Grade','grade_id');
    }

    public function points()
    {
    	return $this->hasMany('App\Point');
    }
}
