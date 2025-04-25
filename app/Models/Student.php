<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'name',
        'last_name_paternal',
        'last_name_maternal',
        'birth_date',
        'address',
        'phone_number',
        'phone_number_emergency',
        'email',
        'gender',
        'representative_id',
        'use_image',
    ];

    public function representative(): BelongsTo
    {
        return $this->belongsTo(Representative::class);
    }

    public function studentGrades(): HasMany
    {
        return $this->hasMany(StudentGrade::class)->orderBy('obtained_date');
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function championshipRegistrations(): HasMany
    {
        return $this->hasMany(ChampionshipRegistration::class);
    }

    public function currentGrade(): ?BelongsTo
    {
        $lastGrade = $this->studentGrades()->latest('obtained_date')->first();

        return $lastGrade ? $lastGrade->grade() : null;
    }

    public function currentGradeObtainedDate(): ?\Illuminate\Support\Carbon
    {
        $lastGrade = $this->studentGrades()->latest('obtained_date')->first();

        return $lastGrade ? $lastGrade->obtained_date : null;
    }

}
