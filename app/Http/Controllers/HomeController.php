<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        return view('home');
    }
    
    public function courses()
    {
        $courses = Course::all();
        return view('courses',compact('courses'));
    }
    
    public function myCourses()
    {
         $user = auth()->user();
        $courses = Course::join('enrollments', 'courses.id', '=', 'enrollments.course_id')
            ->where('enrollments.user_id', '=', $user->id)
            ->select('courses.*')
            ->paginate(10);
        return view('courses',compact('courses'));
    }
}
