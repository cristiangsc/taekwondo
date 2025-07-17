<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Equipment extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'code',
        'category_id',
        'description',
        'purchase_price',
        'purchase_date',
        'condition',
        'status',
        'size',
        'color',
        'brand',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function maintenanceRecords(): HasMany
    {
        return $this->hasMany(MaintenanceRecord::class);
    }

    public function currentLoan(): ?Loan
    {
        return $this->loans()->where('status', 'activo')->first();
    }

    public function isAvailable(): bool
    {
        return $this->status === 'disponible';
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'disponible' => 'success',
            'prestado' => 'warning',
            'en_mantenimiento' => 'info',
            'perdido' => 'danger',
            'dañado' => 'danger',
            default => 'secondary'
        };
    }

    public function getConditionColorAttribute(): string
    {
        return match($this->condition) {
            'excelente' => 'success',
            'bueno' => 'primary',
            'regular' => 'warning',
            'malo' => 'danger',
            default => 'secondary'
        };
    }
}
