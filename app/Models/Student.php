<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Student extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'rut',
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
        'admission_date',
        'grade_id',
        'full_name'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(800)
            ->height(600)
            ->sharpen(10)
            ->nonQueued();
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }
    protected function lastNamePaternal(): Attribute
    {
        return Attribute::make(
            set: fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }
    protected function lastNameMaternal(): Attribute
    {
        return Attribute::make(
            set: fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }

    protected $appends = [
        'age',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'admission_date' => 'date',
        'use_image' => 'boolean',
    ];

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->birth_date?->age,
        );
    }

    public function representative(): BelongsTo
    {
        return $this->belongsTo(Representative::class);
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

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class)->orderByDesc('order');
    }

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class, 'student_grades')
            ->withPivot('obtained_date', 'notes')
            ->withTimestamps();
    }

    public function currentGrade(): ?Grade
    {
        return $this->grades->sortByDesc('pivot_obtained_date')->first();
    }


    public function currentGradeObtainedDate(): ?\Illuminate\Support\Carbon
    {
        $lastGrade = $this->grades()->orderByDesc('pivot_obtained_date')->first();

        return $lastGrade?->pivot->obtained_date;
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

}
