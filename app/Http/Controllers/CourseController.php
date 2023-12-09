<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();

        return Inertia::render('App/Courses/Parts/Index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('App/Courses/Parts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            $thumnailPath = $request->thumbnail ? $request->file('thumbnail')->store('courses/thumbnails') : null;
            $thumnailVideoPath = $request->video_thumbnail ? $request->file('video_thumbnail')->store('courses/video_thumbnails') : null;

            Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail' => $thumnailPath,
                'video_thumbnail' => $thumnailVideoPath,
            ]);

            $this->flashSuccess("Course $request->title has been added!");
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load('sections');
        return Inertia::render('App/Courses/Parts/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
