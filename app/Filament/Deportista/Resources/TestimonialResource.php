<?php

namespace App\Filament\Deportista\Resources;

use App\Filament\Deportista\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Testimonios';
    protected static ?string $breadcrumb = 'Testimonios';
    protected static ?string $navigationGroup = 'Página web';


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('student_id', auth()->id());
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()
            ->where('student_id', auth()->id())
            ->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('student_name')
                    ->label('Deportista')
                    ->default(auth()->user()->full_name)
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\Textarea::make('content')
                    ->label('Testimonio')
                    ->required()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Deportista')
                    ->icon('gmdi-sports-martial-arts-o')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Testimonio')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label('¿Aprobado?')
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->visible(fn($record) => !$record->is_approved),
                Tables\Actions\DeleteAction::make()
                    ->label(''),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function canEdit($record): bool
    {
        return !$record->is_approved;
    }

}
