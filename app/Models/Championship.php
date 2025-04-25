<?php

namespace App\Models;

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

}
