<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = ['name', 'student_id', 'content', 'is_approved'];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

}
