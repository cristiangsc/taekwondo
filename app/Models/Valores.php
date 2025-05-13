<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Valores extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'valores';
    protected $fillable = [
        'id',
        'valor',
        'description'
    ];


}
