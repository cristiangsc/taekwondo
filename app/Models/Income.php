<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    protected $fillable = ['monto_ingreso','income_type_id','anio','fecha','observacion'];
    protected $table = 'incomes';

    public function income_type():BelongsTo
    {
        return $this->belongsTo(IncomeType::class);
    }
}
