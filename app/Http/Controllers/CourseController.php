<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->limit = 5;
    }
    
    public function index()
    {
        $courses = Course::paginate($this->limit);

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'video_url' => 'required|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $validated["user_id"] = auth()->user()->id;
        
        $course = Course::create($validated);
        
        // Handle profile picture upload
        if ($request->hasFile('image')) {
            $cover = $request->file('image');
            $filename = time() . '_' . $cover->getClientOriginalName();
            $path = $cover->storeAs('cover', $filename);
            $course->image = $filename;        
        }

        $course->save();

        return redirect()->route('admin.courses.show', $course->id);
    }

    public function show(Request $request)
    {
        $course = Course::find($request->id);
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Request $request)
    {
        $course = Course::find($request->id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request)
    {
        $course = Course::find($request->id);
        
        $validated = $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'video_url' => 'required|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date',         
        ]);

        $validated["user_id"] = auth()->user()->id;

        $course->update($validated);
        
        // Handle profile picture upload
        if ($request->hasFile('image')) {
            $course->deleteCoverImage();
            $cover = $request->file('image');
            $filename = time() . '_' . $cover->getClientOriginalName();
            $path = $cover->storeAs('cover', $filename);
            $course->image = $filename;        
        }
        
        $course->save();

        return redirect()->route('admin.courses.show', $course);
    }

    public function destroy(Request $request)
    {
        $course = Course::find($request->id);
        $course->delete();

        return redirect()->route('admin.courses.index');
    }
    
}


?>