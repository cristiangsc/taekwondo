<?php

namespace App\Filament\Resources;

use App\Enums\TypeGrade;
use App\Filament\Resources\GradeResource\Pages;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'hugeicons-navigator-01';
    protected static ?string $navigationLabel = 'Grados';
    protected static ?string $breadcrumb = 'Grados';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->prefixIcon('heroicon-o-cog-8-tooth')
                    ->label('Tipo')
                    ->options(collect(TypeGrade::cases())->pluck('value', 'value'))
                    ->required(),
                Forms\Components\TextInput::make('level')
                    ->prefixIcon('hugeicons-sort-by-up-02')
                    ->label('Nivel')
                    ->maxValue(10)
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->prefixIcon('hugeicons-edit-table')
                    ->label('Nombre del grado')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->prefixIcon('heroicon-o-numbered-list')
                    ->label('Orden de importancia')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('level')
                    ->label('Nivel')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre del grado')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->alignCenter()
                    ->label('Orden de importancia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label(''),
                Tables\Actions\DeleteAction::make()
                ->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}
