<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    protected $fillable = [
        'type',
        'level',
        'name',
        'order',
    ];

    public function studentGrades(): HasMany
    {
        return $this->hasMany(StudentGrade::class);
    }

    public function previousExams(): HasMany
    {
        return $this->hasMany(Exam::class, 'previous_grade_id');
    }

    public function currentExams(): HasMany
    {
        return $this->hasMany(Exam::class, 'current_grade_id');
    }
}
