<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $breadcrumb = 'Usuarios';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->prefixIcon('heroicon-o-user')
                    ->label('Nombres')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->prefixIcon('heroicon-o-envelope')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
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
                    ->label('Nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-o-envelope')
                    ->label('Correo Electrónico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label('')
                ->modalHeading('Editar Usuario'),
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
            'index' => Pages\ListUsers::route('/'),
          //  'create' => Pages\CreateUser::route('/create'),
          //  'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
