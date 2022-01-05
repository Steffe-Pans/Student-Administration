<?php

namespace App\Http\Controllers;

use App\Course;
use App\Courses;
use App\Helpers\Json;
use App\Programmes;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request) {
        $programme_id = $request->input('programme_id') ?? '%';
        $course_name_desc = "%" . $request->input("course") . '%';
        $courses = Course::with('programme')
        ->where([
            ['programme_id', 'like', $programme_id],
            ['name', 'like', $course_name_desc]
        ])
        ->orWhere([
            ['programme_id', 'like', $programme_id],
            ['description', 'like', $course_name_desc]
        ])
            ->orderBY('name')
            ->get()
            ->makeHidden(["created_at", "updated_at"]);

        $order = Programmes::orderBy('id')->get();
        $programmes = Programmes::orderBy('name')
//            ->has('Courses')
//            ->withcount('Courses')
            ->get()
            ->transform(function ($item, $key) {
                $item->name = strtoupper($item->name);
                return $item;
            });
        $result = compact('courses','programmes', 'order');
        (new \App\Helpers\Json)->dump($result);
        return view('courses.index', $result);
    }
    public function show($id)
    {
        $courses = Course::with('programme')
            ->with('studentCourses.student')
            ->findOrFail($id)
            ->makeHidden(["created_at", "updated_at"]);
        $studentCourses = $courses->studentCourses;

        $result = compact("courses", "id", "studentCourses");
        (new \App\Helpers\Json)->dump($result);
//        dd($result);
        // goes to page and sends id to the view
        return view("courses.show", $result);
    }
}
