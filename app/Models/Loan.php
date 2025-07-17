<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'student_id',
        'equipment_id',
        'loaned_at',
        'expected_return_date',
        'returned_at',
        'loaned_by',
        'returned_by',
        'status',
        'loan_notes',
        'return_notes',
        'equipment_condition_loan',
        'equipment_condition_return',
    ];

    protected $casts = [
        'loaned_at' => 'datetime',
        'expected_return_date' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function loanedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'loaned_by');
    }

    public function returnedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'returned_by');
    }

    public function isOverdue(): bool
    {
        return $this->status === 'activo' && Carbon::now()->isAfter($this->expected_return_date);
    }

    public function getDaysOverdueAttribute(): int
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        return Carbon::now()->diffInDays($this->expected_return_date);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'activo' => $this->isOverdue() ? 'danger' : 'success',
            'devuelto' => 'primary',
            'vencido' => 'warning',
            'perdido' => 'danger',
            default => 'secondary'
        };
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($loan) {
            // Actualizar el estado del equipo al prestarlo
            if (empty($loan->loaned_by)) {
                $loan->loaned_by = auth()->id();
            }
            $loan->equipment->update(['status' => 'prestado']);
        });

        static::updating(function ($loan) {
            // Si se devuelve el equipo, actualizar su estado
            if (empty($loan->returned_by)) {
                $loan->returned_by = auth()->id();
            }

            if ($loan->isDirty('status') && $loan->status === 'devuelto') {
                $loan->equipment->update(['status' => 'disponible']);
            }

            // Si cambia de devuelto a activo
            if ($loan->isDirty('status') && $loan->status === 'activo' && $loan->getOriginal('status') === 'devuelto') {
                $loan->returned_at = null;
                $loan->equipment_condition_return = null;
                $loan->returned_by = null;
                $loan->return_notes = null;
                $loan->equipment->update(['status' => 'prestado']);
            }

        });
    }
}
