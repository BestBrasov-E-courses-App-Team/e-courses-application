<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SectionLesson extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = [
        'media_url'
    ];


    public function section()
    {
        return $this->belongsTo(SectionLesson::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function mediaUrl(): Attribute
    {
        return new Attribute(
            get: fn () => $this->media_path ? Storage::url($this->media_path) : null,
        );
    }
}
