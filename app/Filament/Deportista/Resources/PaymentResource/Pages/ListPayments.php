<?php

namespace App\Filament\Deportista\Resources\PaymentResource\Pages;

use App\Filament\Deportista\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;
    protected static ?string $title = 'Pagos de mensualidad';
}
