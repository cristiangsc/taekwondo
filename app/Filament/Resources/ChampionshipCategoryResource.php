<?php

namespace App\Filament\Resources;

use App\Enums\TypeGrade;
use App\Filament\Resources\ChampionshipCategoryResource\Pages;
use App\Models\ChampionshipCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ChampionshipCategoryResource extends Resource
{
    protected static ?string $model = ChampionshipCategory::class;

    protected static ?string $navigationIcon = 'carbon-category';
    protected static ?string $navigationGroup = 'Championships';
    protected static ?string $navigationLabel = 'Categorías';
    protected static ?string $breadcrumb = 'Categorías';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre Categoría')
                    ->placeholder('Nombre de la categoría')
                    ->prefixIcon('heroicon-o-pencil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('types')
                    ->label('Tipos de Categoría')
                    ->options(collect(TypeGrade::cases())->pluck('value', 'value'))
                    ->prefixIcon('carbon-category')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre Categoría')
                    ->icon('carbon-category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('types')
                    ->label('Tipo Categoría'),
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
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->modalHeading('Editar Categoría'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->modalHeading('Eliminar Categoría')
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
            'index' => Pages\ListChampionshipCategories::route('/'),
//            'create' => Pages\CreateChampionshipCategory::route('/create'),
//            'edit' => Pages\EditChampionshipCategory::route('/{record}/edit'),
        ];
    }
}
