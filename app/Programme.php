<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    public function students(){
        // a programme has one or many students
        return $this->hasMany("App\Students");
    }

    public function courses(){
        // a programme has one or many courses
        return $this->hasMany("App\Course");
    }
}
