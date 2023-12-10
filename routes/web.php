<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\SectionLessonController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        $coursesCount = Course::count();
        $recentCourses = Course::orderBy('id', 'desc')->take(6)->get();
        $hoursThisWeek = rand(1, 24);
        $completedTasks = rand(1, 14);
        return Inertia::render('Dashboard', compact('coursesCount', 'hoursThisWeek', 'completedTasks', 'recentCourses'));
    })->name('dashboard');
    
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
    Route::get('courses/{course}/details', [CourseController::class, 'details'])->name('courses.details');
    Route::resource('course-sections', CourseSectionController::class);
    Route::resource('section-lessons', SectionLessonController::class);
    Route::resource('attachments', AttachmentController::class);
});
