<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Nicolaslopezj\Searchable\SearchableTrait;

class Course extends Model
{
    use HasFactory;
    use SearchableTrait;

    protected $guarded = [];
    protected $appends = [
        'thumbnail_url',
        'video_thumbnail_url',
    ];


    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'courses.title' => 50,
            'courses.description' => 30,
            'course_sections.title' => 2,
        ],
        'joins' => [
            'course_sections' => ['courses.id', 'course_sections.course_id'],
        ],
    ];

    public function sections() {
        return $this->hasMany(CourseSection::class);
    }
    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn () => $this->thumbnail ? Storage::url($this->thumbnail) : null,
        );
    }
    public function videoThumbnailUrl(): Attribute
    {
        return new Attribute(
            get: fn () => $this->video_thumbnail ? Storage::url($this->video_thumbnail) : null,
        );
    }
}
