<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{

    public function __construct()
    {
        $this->limit = 5;
    }

    public function index()
    {
        $enrollments = Enrollment::orderByDesc('created_at')->paginate($this->limit);
    
        return view('admin.enroll.index', compact('enrollments'));
    }
        
    public function mycourses()
    {
         
         return view('admin.enroll.index', compact('enrollments'));
    }
    
        
    public function enroll($course_id)
    {
        $course = Course::find($course_id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found!');
        }

        $user = Auth::user();

        if ($user->enrollments()->where('course_id', $course_id)->exists()) {
            return redirect()->back()->with('error', 'You have already enrolled in this course!');
        }

        $enrollment = new Enrollment();
        $enrollment->course_id = $course_id;
        $enrollment->user_id = $user->id;
        $enrollment->save();

        return redirect()->back()->with('success', 'You have successfully enrolled in the course!');
    }

    public function unenroll($course_id)
    {
        $user = Auth::user();
        $enrollment = $user->enrollments()->where('course_id', $course_id)->first();

        if (!$enrollment) {
            return redirect()->back()->with('error', 'You have not enrolled in this course yet!');
        }

        $enrollment->delete();

        return redirect()->back()->with('success', 'You have successfully unenrolled from the course!');
    }
    
    public function suspended(Request $request)
    {
        $enrollment = Enrollment::find($request->id);
        $enrollment->status = 'suspended';        
        $enrollment->save();
        return redirect()->back()->with('success', 'You have successfully Suspended from the course!');
    }
    
    public function cancelled(Request $request)
    {
        $enrollment = Enrollment::find($request->id);
        $enrollment->status = 'cancelled';        
        $enrollment->save();
        return redirect()->back()->with('success', 'You have successfully Cancelled the course!');
    }
    
     public function revoke(Request $request)
    {
        $enrollment = Enrollment::find($request->id);
        $enrollment->status = 'applied';        
        $enrollment->save();
        return redirect()->back()->with('success', 'You have successfully Revoked the course!');
    }
}


?>