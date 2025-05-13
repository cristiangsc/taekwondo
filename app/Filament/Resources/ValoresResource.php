<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ValoresResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Models\Valores;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ValoresResource extends Resource
{
    protected static ?string $model = Valores::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Página web';
    protected static ?string $navigationLabel = 'Valores destacados';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('valor')
                    ->label('Valor')
                    ->placeholder('Ingrese un valor a destacar')
                    ->prefixIcon('heroicon-o-pencil')
                    ->unique('valores', 'valor', ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción del valor')
                    ->placeholder('Ingrese una descripción del valor')
                    ->columnSpanFull(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Imagen del valor')
                    ->collection('valores')
                    ->image()
                    ->imageEditor()
                    ->openable()
                    ->optimize('png','jpg')
                    ->resize(30)
                    ->imageResizeTargetWidth('300')
                    ->imageResizeTargetHeight('300')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('valor')
                    ->label('Valor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Imagen')
                    ->collection('valores')
                    ->conversion('thumb')
                    ->circular()
                    ->alignCenter(),
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
            'index' => Pages\ListValores::route('/'),
            'create' => Pages\CreateValores::route('/create'),
            'edit' => Pages\EditValores::route('/{record}/edit'),
        ];
    }
}
