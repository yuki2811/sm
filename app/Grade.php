<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';

    public function classes()
    {
    	return $this->hasMany('App\Classes');
    }

    public function subjects()
    {
    	return $this->hasMany('App\Subject');
    }
}
