<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;


class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $breadcrumb = 'Documentos';
    protected static ?string $navigationLabel = 'Documentos';
    protected static ?string $navigationGroup = 'Documentos';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Descripción del documento')
                    ->columnSpanFull()
                    ->unique(static::getModel(), 'description', ignoreRecord: true)
                    ->required(),
                SpatieMediaLibraryFileUpload::make('Documentos')
                    ->columnSpanFull()
                    ->collection('documents')
                    ->required()
                    ->openable(),
            ]);
    }

    public static function table(Table $table): Table
    {
       return $table
        ->columns([
            TextColumn::make('user.full_name')
                ->label('Responsable de la carga')
                ->formatStateUsing(fn(?string $state): string => mb_strtoupper($state ?? '', 'UTF-8'))
                ->numeric()
                ->sortable()
                ->searchable(),
            TextColumn::make('description')
                ->label('Descripción')
                ->formatStateUsing(fn(?string $state): string => mb_strtoupper($state ?? '', 'UTF-8'))
                ->sortable()
                ->searchable(),
            TextColumn::make('file_type')
                ->label('Tipo de archivo')
                ->getStateUsing(function (Document $record) {
                    $media = $record->getFirstMedia('documents');
                    return $media ? pathinfo($media->file_name, PATHINFO_EXTENSION) : 'No disponible';
                })
                ->alignCenter(),
            TextColumn::make('created_at')
                ->label('Fecha Creación')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->label('Fecha Actualización')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])->defaultSort('created_at', 'desc')
            ->actions([
                MediaAction::make()
                    ->media(fn($record) => $record->getFirstMediaUrl('documents'))
                    ->label('')
                    ->tooltip('Ver PDF')
                    ->icon('hugeicons-pdf-01')
                    ->color('rose')
                    ->visible(function (Document $record) {
                        $media = $record->getFirstMedia('documents');
                        return $media ? pathinfo($media->file_name, PATHINFO_EXTENSION) === 'pdf' : 'No disponible';
                    }),
                ViewAction::make()
                    ->modalHeading('Documentos')
                    ->label('')
                    ->tooltip('Ver documento'),
                EditAction::make()
                    ->label(''),
                DeleteAction::make()
                    ->modalHeading('Está Eliminando el documento registrado')
                    ->label(''),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->modalHeading('Está Eliminando el o los documentos registrados'),
                ]),
            ]);

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
