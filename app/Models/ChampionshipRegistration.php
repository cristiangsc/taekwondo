<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChampionshipRegistration extends Model
{
    protected $fillable = [
        'student_id',
        'championship_category_id',
        'registration_date',
        'championship_id',
        'mode',
        'notes',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ChampionshipCategory::class, 'championship_category_id');
    }

    public function championship(): BelongsTo
    {
        return $this->belongsTo(Championship::class);
    }
}
