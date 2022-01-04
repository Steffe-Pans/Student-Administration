<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    public function programme(){
        // a student belong so a programme
        return $this->belongsTo("App\Programmes");
    }

    public function studentcourses(){
        // a student follows many student courses
        return $this->hasMany("App\student_courses");
    }
}
