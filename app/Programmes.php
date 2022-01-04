<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programmes extends Model
{
    public function students(){
        // a programme has many students
        return $this->hasMany("App\Students");
    }

    public function courses(){
        // a programme has many courses
        return $this->hasMany("App\Courses");
    }
}
