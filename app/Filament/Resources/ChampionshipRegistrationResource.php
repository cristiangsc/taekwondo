<?php

namespace App\Filament\Resources;

use App\Enums\Mode;
use App\Filament\Resources\ChampionshipRegistrationResource\Pages;
use App\Models\ChampionshipRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ChampionshipRegistrationResource extends Resource
{
    protected static ?string $model = ChampionshipRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Championships';
    protected static ?string $navigationLabel = 'Inscripción Campeonato';
    protected static ?string $breadcrumb = 'Inscripciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Nombre del Estudiante')
                    ->relationship('student', 'full_name')
                    ->required(),
                Forms\Components\Select::make('championship_id')
                    ->label('Nombre del Campeonato')
                    ->relationship('championship', 'name')
                    ->required(),
                Forms\Components\Select::make('championship_category_id')
                    ->label('Categoría')
                    ->relationship('category', 'category')
                    ->required(),
                Forms\Components\DatePicker::make('registration_date')
                    ->label('Fecha de Inscripción')
                    ->required(),
                Forms\Components\TextInput::make('registration_fee')
                    ->label('Cuota de Inscripción')
                    ->numeric()
                    ->default(null),
                Forms\Components\Select::make('mode')
                    ->label('Modalidad')
                    ->options(collect(Mode::cases())->pluck('value', 'value'))
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Observaciones')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('championship.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('championship_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registration_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registration_fee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mode'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('registration_date', 'desc')
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
            'index' => Pages\ListChampionshipRegistrations::route('/'),
            'create' => Pages\CreateChampionshipRegistration::route('/create'),
            'edit' => Pages\EditChampionshipRegistration::route('/{record}/edit'),
        ];
    }
}
