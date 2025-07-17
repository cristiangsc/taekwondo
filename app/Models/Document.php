<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Document extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['description','user_id'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($document) {
            $document->user_id = auth()->id();
        });
        static::updating(function ($document) {
            $document->user_id = auth()->id();
        });
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
