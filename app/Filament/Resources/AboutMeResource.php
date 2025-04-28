<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutMeResource\Pages;
use App\Models\AboutMe;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;


class AboutMeResource extends Resource
{
    protected static ?string $model = AboutMe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Página web';
    protected static ?string $navigationLabel = 'Acerca de';
    protected static ?string $breadcrumb = 'Acerca de';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('history')
                    ->required()
                    ->maxLength(65535)
                    ->label('Historia')
                    ->columnSpanFull(),
                RichEditor::make('mission')
                    ->required()
                    ->maxLength(65535)
                    ->label('Misión')
                    ->columnSpanFull(),
                RichEditor::make('vision')
                    ->required()
                    ->maxLength(65535)
                    ->label('Visión')
                    ->columnSpanFull(),
                RichEditor::make('values')
                    ->required()
                    ->maxLength(65535)
                    ->label('Valores')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('imagenes')
                    ->label('Imágenes')
                    ->collection('acerca_de')
                    ->image()
                    ->multiple()
                    ->responsiveImages()
                    ->imageEditor()
                    ->openable()
                    ->optimize('jpg')
                    ->resize(30)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('history')
                    ->label('Historia')
                    ->searchable()
                    ->html()
                    ->limit(50),
                Tables\Columns\TextColumn::make('mission')
                    ->label('Misión')
                    ->searchable()
                    ->html()
                    ->limit(50),
                Tables\Columns\TextColumn::make('vision')
                    ->label('Visión')
                    ->searchable()
                    ->html()
                    ->limit(50),
                Tables\Columns\TextColumn::make('values')
                    ->label('Valores')
                    ->searchable()
                    ->html()
                    ->limit(50),
                SpatieMediaLibraryImageColumn::make('imagenes')
                    ->label('Imágenes')
                    ->collection('acerca_de')
                    ->limit(4)
                    ->circular()
                    ->size(50)
                    ->wrap(),
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
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->modalHeading('Eliminar Antecedentes')
                    ->requiresConfirmation()
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
            'index' => Pages\ListAboutMes::route('/'),
            'create' => Pages\CreateAboutMe::route('/create'),
            'edit' => Pages\EditAboutMe::route('/{record}/edit'),
        ];
    }
}
