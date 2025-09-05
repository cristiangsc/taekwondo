<?php

namespace App\Filament\Deportista\Resources\TestimonialResource\Pages;

use App\Filament\Deportista\Resources\TestimonialResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTestimonial extends CreateRecord
{
    protected static string $resource = TestimonialResource::class;
    protected static ?string $title = 'Crear testimonio';

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['student_id'] = auth()->id();
        $data['is_approved'] = false;
        return $data;
    }

}
