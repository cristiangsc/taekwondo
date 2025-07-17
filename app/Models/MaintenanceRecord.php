<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRecord extends Model
{
    protected $fillable = [
        'equipment_id',
        'type',
        'description',
        'cost',
        'maintenance_date',
        'performed_by',
    ];

    protected $casts = [
        'maintenance_date' => 'date',
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function performedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    public function getTypeColorAttribute(): string
    {
        return match($this->type) {
            'preventivo' => 'success',
            'correctivo' => 'warning',
            'limpieza' => 'info',
            default => 'secondary'
        };
    }
}
