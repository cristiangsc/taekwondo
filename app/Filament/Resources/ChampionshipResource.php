<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChampionshipResource\Pages;
use App\Models\Championship;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ChampionshipResource extends Resource
{
    protected static ?string $model = Championship::class;
    protected static ?string $navigationGroup = 'Championships';
    protected static ?string $navigationLabel = 'Campeonatos';
    protected static ?string $navigationIcon = 'hugeicons-champion';
    protected static ?string $breadcrumb = 'Campeonatos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre del Campeonato')
                    ->placeholder('Nombre del Campeonato')
                    ->prefixIcon('hugeicons-champion')
                    ->required()
                    ->columnSpan('full')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Fecha de Inicio')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Fecha de Término')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->label('Ubicación')
                    ->placeholder('Ubicación del Campeonato')
                    ->prefixIcon('carbon-map')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('year')
                    ->label('Año')
                    ->placeholder('Año del Campeonato')
                    ->prefixIcon('carbon-calendar')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre del Campeonato')
                    ->icon('hugeicons-champion')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Fecha de Inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Fecha de Término')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Ubicación')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Año')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('start_date', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label('')
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
            'index' => Pages\ListChampionships::route('/'),
            'create' => Pages\CreateChampionship::route('/create'),
            'edit' => Pages\EditChampionship::route('/{record}/edit'),
        ];
    }
}
