<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
    protected $fillable = ['name'];
    protected $table = 'income_types';

}
