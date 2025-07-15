<?php

namespace App\Models;

use App\Enums\MonthEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Cuota extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['year','amount', 'payment_date', 'observation','month','student_id','cuota_id'];

    protected $casts = ['payment_date'=>'date'];

    protected function casts(): array
    {
        return [
            'month' > MonthEnum::class,
        ];
    }

    public function valorCuota(): BelongsTo
    {
        return $this->belongsTo(ValorCuota::class, 'cuota_id');

    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
