<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Championship extends Model
{
    protected $fillable = [
        'name',
        'year',
        'start_date',
        'end_date',
        'location',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(ChampionshipRegistration::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }

}
