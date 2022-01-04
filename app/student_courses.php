<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_courses extends Model
{
    public function student(){
        // a student belongs to 1 student course
        return $this->belongsTo("App\Students")->withDefault();
    }

    public function courses(){
        // a course belongs to 1 student course
        return $this->belongsTo("App\Courses")->withDefault();
    }
}
