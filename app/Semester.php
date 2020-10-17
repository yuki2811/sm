<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';

    public function classes()
    {
    	return $this->hasMany('App\Classes');
    }
}
