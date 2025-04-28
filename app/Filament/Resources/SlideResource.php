<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideResource\Pages;
use App\Models\Slide;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Carrusel';
    protected static ?string $navigationGroup = 'Página web';
    protected static ?string $breadcrumb = 'Carrusel';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subtitle')
                    ->label('Subtítulo')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->default(null),
                Forms\Components\Toggle::make('is_active')
                    ->label('¿Activo?')
                    ->default(true),
                SpatieMediaLibraryFileUpload::make('imagen')
                    ->label('Imagen')
                    ->collection('carrusel')
                    ->image()
                    ->responsiveImages()
                    ->imageEditor()
                    ->openable()
                    ->optimize('jpg')
                    ->resize(30)
                    ->columnSpanFull()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtítulo')
                    ->limit(100)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('¿Activo?')
                    ->boolean(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('imagen')
                    ->collection('carrusel')
                    ->label('Imagen')
                    ->circular()
                    ->size(50),
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
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('Está Eliminando el carrusel')
                    ->label(''),
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
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
