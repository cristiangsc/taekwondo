<?php

namespace App\Filament\Apoderado\Resources\PaymentResource\Pages;

use App\Filament\Apoderado\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;
    protected static ?string $title = 'Pagos de mensualidad';

}
