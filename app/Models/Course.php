<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
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
    protected $with = ['author'];
    protected $appends = [
        'thumbnail_url',
        'video_thumbnail_url',
    ];

    protected $casts = [
        'misc' => AsArrayObject::class,
    ];


    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y H:i:s');
    }
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
            'courses.misc' => 30,
            'users.name' => 20,
            'users.email' => 15,
            'course_sections.title' => 2,
        ],
        'joins' => [
            'course_sections' => ['courses.id', 'course_sections.course_id'],
            'users' => ['courses.user_id', 'users.id'],
        ],
    ];

    public function sections() {
        return $this->hasMany(CourseSection::class);
    }
    public function author() {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
