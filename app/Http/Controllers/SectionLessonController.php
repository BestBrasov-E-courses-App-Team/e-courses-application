<?php

namespace App\Http\Controllers;

use App\Models\SectionLesson;
use App\Http\Requests\StoreSectionLessonRequest;
use App\Http\Requests\UpdateSectionLessonRequest;
use App\Models\CourseSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $section = CourseSection::findOrFail($request->section_id);
        $section->load('course');
        return Inertia::render('App/Lessons/Parts/Create', [
            'section' => $section,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionLessonRequest $request)
    {
        try {
            $section =  CourseSection::with('course')->findOrFail($request->section_id);
            SectionLesson::create([
                'title' => $request->title,
                'description' => $request->description,
                'course_section_id' => $section->id,
                'course_id' => $section->course->id,
            ]);

            $this->flashSuccess("Lesson $request->title has been added!");
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SectionLesson $sectionLesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionLesson $sectionLesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionLessonRequest $request, SectionLesson $sectionLesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SectionLesson $sectionLesson)
    {
        //
    }
}
