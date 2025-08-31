<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Representative extends  User
{
    use Notifiable;

    protected $fillable = [
        'name',
        'relationship',
        'phone_number',
        'email',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

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
