<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChampionshipRegistrationResource\Pages;
use App\Filament\Resources\ChampionshipRegistrationResource\RelationManagers;
use App\Models\ChampionshipRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChampionshipRegistrationResource extends Resource
{
    protected static ?string $model = ChampionshipRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Championships';
    protected static ?string $navigationLabel = 'Inscripciones Campeonatos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Forms\Components\Select::make('championship_id')
                    ->relationship('championship', 'name')
                    ->required(),
                Forms\Components\TextInput::make('championship_category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('registration_date')
                    ->required(),
                Forms\Components\TextInput::make('registration_fee')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('mode'),
                Forms\Components\Textarea::make('notes')
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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
