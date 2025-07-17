<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
   protected $fillable = ['monto_gasto','expense_type_id','anio','fecha','observacion'];
   protected $table = 'expenses';

   public function expense_type():BelongsTo
   {
       return $this->belongsTo(ExpenseType::class);
   }

}

