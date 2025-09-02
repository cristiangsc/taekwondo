<?php

namespace App\Filament\Apoderado\Resources;

use App\Enums\Relacion;
use App\Filament\Apoderado\Resources\RepresentativeResource\Pages;
use App\Filament\Apoderado\Resources\RepresentativeResource\RelationManagers;
use App\Models\Representative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class RepresentativeResource extends Resource
{
    protected static ?string $model = Representative::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Apoderados';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->prefixIcon('heroicon-o-user')
                    ->label('Nombre completo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('relationship')
                    ->prefixIcon('heroicon-o-user-group')
                    ->label('Relación')
                    ->options(collect(Relacion::cases())->pluck('value', 'value'))
                    ->disabled(),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Teléfono')
                    ->prefixIcon('heroicon-o-phone')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->minLength(9)
                    ->maxLength(11)
                    ->default(null),
                Forms\Components\TextInput::make('email')
                    ->prefixIcon('heroicon-o-envelope')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('address')
                    ->label('Dirección')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('password')
                    ->prefixIcon('heroicon-o-key')
                    ->label('Contraseña')
                    ->password()
                    ->required()
                    ->maxLength(20),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre completo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('relationship')
                    ->label('Relación')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Teléfono')
                    ->icon('heroicon-m-phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->icon('heroicon-m-home')
                    ->label('Dirección')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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

    public static function getRelations(): array
    {
        return [
         //   StudentsRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRepresentatives::route('/'),
            'create' => Pages\CreateRepresentative::route('/create'),
            'edit' => Pages\EditRepresentative::route('/{record}/edit'),
        ];
    }
}
