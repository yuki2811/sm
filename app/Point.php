<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
     protected $table = 'points';

    public function students()
    {
    	return $this->belongsTo('App\Student','student_id');
    }

    public function subjects()
    {
    	return $this->belongsTo('App\Subject','subject_id');
    }
}
