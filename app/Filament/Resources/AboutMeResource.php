<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutMeResource\Pages;
use App\Models\AboutMe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class AboutMeResource extends Resource
{
    protected static ?string $model = AboutMe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
        protected static ?string $navigationLabel = 'Acerca de';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('history')
                    ->required()
                    ->maxLength(65535)
                    ->label('Historia')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('mission')
                    ->required()
                    ->maxLength(65535)
                    ->label('Misión')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('vision')
                    ->required()
                    ->maxLength(65535)
                    ->label('Visión')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('values')
                    ->required()
                    ->maxLength(65535)
                    ->label('Valores')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('history')
                    ->label('Historia')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('mission')
                    ->label('Misión')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('vision')
                    ->label('Visión')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('values')
                    ->label('Valores')
                    ->searchable()
                    ->limit(50),
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
            'index' => Pages\ListAboutMes::route('/'),
            'create' => Pages\CreateAboutMe::route('/create'),
            'edit' => Pages\EditAboutMe::route('/{record}/edit'),
        ];
    }
}
