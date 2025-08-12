<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'content','published','views'];

    protected $casts = [
        'published' => 'boolean',
        'views' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('image');
    }

    /**
     * Incrementa vistas con límite por IP
     * Más sofisticado: evita bots y múltiples vistas del mismo IP y spam
     */
    public function recordView(): bool
    {
        // Clave única por noticia + IP + día
        $cacheKey = 'news_view_' . $this->id . '_' . request()->ip() . '_' . date('Y-m-d');

        // Si ya vio esta noticia hoy desde esta IP, no contar
        if (cache()->has($cacheKey)) {
            return false;
        }

        // Marcar como visto por 24 horas
        cache()->put($cacheKey, true, now()->addDay());

        // Incrementar contador de forma atómica
        $this->increment('views');

        return true;
    }

    /**
     * Scope para noticias más vistas
     */
    public function scopeMostViewed($query, $limit = 5)
    {
        return $query->where('published', true)
            ->orderBy('views', 'desc')
            ->limit($limit);
    }

    /**
     * Scope para noticias trending (vistas + recientes)
     */
    public function scopeTrending($query, $days = 7, $limit = 5)
    {
        return $query->where('published', true)
            ->where('created_at', '>=', now()->subDays($days))
            ->orderBy('views', 'desc')
            ->limit($limit);
    }

    /**
     * Accessor para mostrar vistas formateadas
     */
    public function getFormattedViewsAttribute(): string
    {
        if ($this->views >= 1000000) {
            return round($this->views / 1000000, 1) . 'M';
        } elseif ($this->views >= 1000) {
            return round($this->views / 1000, 1) . 'K';
        }

        return number_format($this->views);
    }
}
