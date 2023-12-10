<?php

namespace App\Http\Controllers;

use App\Models\SectionLesson;
use App\Http\Requests\StoreSectionLessonRequest;
use App\Http\Requests\UpdateSectionLessonRequest;
use App\Models\CourseSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            $mediaExtension = null;
            $mediaPath = null;
            $mediaType = $request?->media_type;

            if ($mediaType === 'youtube') {
                $mediaPath = $request->media;
            } elseif ($request->file('media')) {
                $file = $request->file('media');
                $mediaPath = $file->storePubliclyAs(
                    'public/lessons/media_files', time().'-'.$file->getClientOriginalName(),
                );
            }

            $section =  CourseSection::with('course')->findOrFail($request->section_id);
            $lesson = SectionLesson::create([
                'title' => $request->title,
                'description' => $request->description,
                'course_section_id' => $section->id,
                'course_id' => $section->course->id,
                'media_path' => $mediaPath,
                'media_extension' => $mediaExtension,
                'media_type' => $mediaType,
            ]);

            $this->flashSuccess("Lesson $request->title has been added!");
            return  redirect()->route('section-lessons.show', $lesson->refresh()->id);
        } catch (\Throwable $th) {
            $this->flashError($th->getMessage());
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SectionLesson $sectionLesson)
    {
        $sectionLesson->load('section');
        return Inertia::render('App/Lessons/Parts/Show', [
            'lesson' => $sectionLesson,
        ]);
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
