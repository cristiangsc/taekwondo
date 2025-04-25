<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChampionshipCategory extends Model
{
    protected $fillable = [
        'name',
        'types'
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(ChampionshipRegistration::class);
    }

}
