<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Payment extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'student_id',
        'payment_date',
        'amount',
        'next_payment_due',
        'payment_start_date',
        'payment_end_date',
        'payment_method',
        'notes',
        'anio',
    ];


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


}
