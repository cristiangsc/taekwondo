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
        'score',
    ];

    protected static function booted(): void
    {
        static::saved(function (Exam $exam) {
            if ($exam->result === 'Aprobado') {
                $exam->student->update([
                    'grade_id' => $exam->current_grade_id
                ]);
            }
        });
    }


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function previousGrade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'previous_grade_id')->orderByDesc('order');
    }

    public function currentGrade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'current_grade_id')->orderByDesc('order');
    }
}
