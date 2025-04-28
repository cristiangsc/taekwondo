<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Slide extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'subtitle',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($slide) {
            $slide->is_active = true;
        });
    }

}
