<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutMe extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'about_me';

    protected $fillable = [
        'history',
        'mission',
        'vision',
        'values',
    ];
}
