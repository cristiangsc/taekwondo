<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    protected $fillable = [
        'student_id',
        'exam_date',
        'previous_grade_id',
        'current_grade_id',
        'result',
        'notes',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function previousGrade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'previous_grade_id');
    }

    public function currentGrade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'current_grade_id');
    }
}
