<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    protected $fillable = [
        'type',
        'level',
        'name',
        'order',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_grades')->withPivot('obtained_date', 'notes')->withTimestamps();
    }

    public function previousExams(): HasMany
    {
        return $this->hasMany(Exam::class, 'previous_grade_id');
    }

    public function currentExams(): HasMany
    {
        return $this->hasMany(Exam::class, 'current_grade_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }
}
