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

    protected static ?string $navigationIcon = 'hugeicons-task-edit-02';
    protected static ?string $navigationGroup = 'Championships';
    protected static ?string $navigationLabel = 'Inscripción Campeonato';
    protected static ?string $breadcrumb = 'Inscripciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Nombre del Deportista')
                    ->placeholder('Seleccione un Deportista')
                    ->prefixIcon('gmdi-sports-martial-arts-s')
                    ->relationship('student', 'full_name')
                    ->required(),
                Forms\Components\Select::make('championship_id')
                    ->placeholder('Seleccione un Campeonato')
                    ->prefixIcon('hugeicons-champion')
                    ->label('Nombre del Campeonato')
                    ->relationship(
                        'championship',
                        'name',
                        fn($query) => $query->orderBy('year', 'desc')
                    )
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->name} ({$record->year})")
                    ->required(),
                Forms\Components\Select::make('championship_category_id')
                    ->placeholder('Seleccione una Categoría')
                    ->prefixIcon('hugeicons-sort-by-up-02')
                    ->label('Categoría')
                    ->relationship('category', 'category')
                    ->required(),
                Forms\Components\DatePicker::make('registration_date')
                    ->label('Fecha de Inscripción')
                    ->required(),
                Forms\Components\TextInput::make('registration_fee')
                    ->label('Cuota de Inscripción')
                    ->placeholder('Cuota de Inscripción')
                    ->prefixIcon('hugeicons-money-receive-square')
                    ->numeric()
                    ->default(null),
                Forms\Components\Select::make('mode')
                    ->label('Modalidad')
                    ->placeholder('Seleccione una Modalidad')
                    ->prefixIcon('carbon-model-builder-reference')
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
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Nombre del Deportista')
                    ->icon('gmdi-sports-martial-arts-s')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('championship.name')
                    ->label('Nombre del Campeonato')
                    ->icon('hugeicons-champion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->icon('hugeicons-sort-by-up-02')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registration_date')
                    ->label('Fecha de Inscripción')
                    ->icon('carbon-calendar')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('registration_fee')
                    ->label('Cuota de Inscripción')
                    ->icon('hugeicons-money-receive-square')
                    ->prefix('$ ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mode')
                    ->label('Modalidad')
                    ->icon('carbon-model-builder-reference')
                    ->sortable(),
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
