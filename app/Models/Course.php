<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = [
        'thumbnail_url',
        'video_thumbnail_url',
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
