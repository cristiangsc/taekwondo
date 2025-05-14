<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnershipResource\Pages;
use App\Filament\Resources\PartnershipResource\RelationManagers;
use App\Models\Partnership;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartnershipResource extends Resource
{
    protected static ?string $model = Partnership::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Alianzas';
    protected static ?string $navigationGroup = 'Página web';
    protected static ?string $breadcrumb = 'Alianzas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->placeholder('Nombre de la alianza')
                    ->prefixIcon('heroicon-o-pencil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->placeholder('Escriba la URL')
                    ->prefixIcon('heroicon-o-pencil')
                    ->maxLength(255)
                    ->default(null),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull()
                    ->label('Contenido'),
                SpatieMediaLibraryFileUpload::make('imagenes')
                    ->label('Imágenes')
                    ->collection('alianza')
                    ->image()
                    ->multiple()
                    ->responsiveImages()
                    ->imageEditor()
                    ->openable()
                    ->optimize('png','jpg')
                    ->imageResizeTargetWidth('300')
                    ->imageResizeTargetHeight('300')
                    ->resize(30)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->html()
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('imagenes')
                    ->label('Imágenes')
                    ->circular()
                    ->collection('alianza'),
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
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('Está Eliminando la Alianza')
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
            'index' => Pages\ListPartnerships::route('/'),
            'create' => Pages\CreatePartnership::route('/create'),
            'edit' => Pages\EditPartnership::route('/{record}/edit'),
        ];
    }
}
