<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Course::class, 'course');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::with(['author:id,name,email']);
        if ($request->q) {
            $courses =$courses->search($request->q);
        } else {
            $courses =$courses->orderBy('id', 'desc');
        }
        $courses = $courses->paginate();

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
            $thumnailPath = $request->thumbnail ? $request->file('thumbnail')->storePubliclyAs('public/courses/thumbnails', time().'-'. $request->file('thumbnail')->getClientOriginalName()) : null;
            $thumnailVideoPath = $request->video_thumbnail ? $request->file('video_thumbnail')->storePubliclyAs('public/courses/video_thumbnails', time().'-'. $request->file('video_thumbnail')->getClientOriginalName()) : null;

            $course = Course::create([
                'title' => $request->title,
                'user_id' => auth()->user()?->id,
                'description' => $request->description,
                'thumbnail' => $thumnailPath,
                'video_thumbnail' => $thumnailVideoPath,
            ]);

            $this->flashSuccess("Course $request->title has been added!");
            return  redirect()->route('courses.show', $course->refresh()->id);
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course->load(['sections', 'sections.lessons']);
        return Inertia::render('App/Courses/Parts/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function details(Course $course)
    {
        $course->load(['sections', 'sections.lessons']);
        return Inertia::render('App/Courses/Parts/CourseDetails', [
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
        try {
            $thumnailPath = $request->thumbnail ? $request->file('thumbnail')->storePubliclyAs('public/courses/thumbnails', time() . '-' . $request->file('thumbnail')->getClientOriginalName()) : null;
            $thumnailVideoPath = $request->video_thumbnail ? $request->file('video_thumbnail')->storePubliclyAs('public/courses/video_thumbnails', time() . '-' . $request->file('video_thumbnail')->getClientOriginalName()) : null;

            $course->thumbnail = $thumnailPath ?? $course->thumbnail;
            $course->video_thumbnail = $thumnailPath ?? $course->video_thumbnail;

            if ($course->save()) {
                $this->flashSuccess("Course $request->title has been updated!");
            } else {
                $this->flashErro("Could not update Course!");
            }
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
