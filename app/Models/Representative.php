<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Representative extends Model
{
    protected $fillable = [
        'name',
        'relationship',
        'phone_number',
        'email',
        'address',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }
}
