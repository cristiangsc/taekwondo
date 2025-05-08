<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'gmdi-sports-martial-arts-o';
    protected static ?string $navigationLabel = 'Deportistas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Antecedentes Personales')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('rut')
                            ->prefixIcon('heroicon-o-user')
                            ->label('Rut')
                            ->required()
                            ->maxLength(12),
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name_paternal')
                            ->label('Apellido Paterno')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name_maternal')
                            ->label('Apellido Materno')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Fecha de Nacimiento')
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->prefixIcon('heroicon-o-user-group')
                            ->label('Género')
                            ->options(collect(Gender::cases())->pluck('value', 'value'))
                            ->required(),
                        Forms\Components\Select::make('grade_id')
                            ->prefixIcon('hugeicons-pavilon')
                            ->label('Grado')
                            ->relationship('grade', 'name')
                            ->required()
                            ->default(null),
                    ]),
                Forms\Components\Section::make('Datos de Contacto')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->prefixIcon('heroicon-o-phone')
                            ->label('Teléfono')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->minLength(9)
                            ->maxLength(11)
                            ->default(null),
                        Forms\Components\TextInput::make('phone_number_emergency')
                            ->label('Teléfono de Emergencia')
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
                    ]),
                Forms\Components\Section::make('Datos de Inscripción')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('representative_id')
                            ->prefixIcon('heroicon-o-user')
                            ->label('Representante y/o Apoderado')
                            ->relationship('representative', 'name')
                            ->default(null),
                        Forms\Components\DatePicker::make('admission_date')
                            ->label('Fecha de Ingreso')
                            ->required(),
                        Forms\Components\Toggle::make('use_image')
                            ->label('¿Autoriza uso de imagen?')
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rut')
                    ->label('Rut')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name_paternal')
                    ->label('Paterno')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name_maternal')
                    ->label('Materno')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->icon('heroicon-m-calendar')
                    ->label('Fecha de Nacimiento')
                    ->alignCenter()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('age')
                    ->label('Edad')
                    ->alignCenter()
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => $state >= 18 ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('phone_number')
                    ->alignCenter()
                    ->label('Teléfono')
                    ->icon('heroicon-m-phone')
                    ->searchable(),
                TextColumn::make('grade.name')
                    ->label('Grado')
                    ->alignCenter()
                    ->sortable()
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make('phone_number_emergency')
                    ->label('Teléfono de Emergencia')
                    ->alignCenter()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Género')
                    ->alignCenter()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('representative.name')
                    ->label('Representante y/o Apoderado')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('use_image')
                    ->label('¿Autoriza imagen?')
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\TextColumn::make('admission_date')
                    ->icon('heroicon-m-calendar')
                    ->label('Fecha de Ingreso')
                    ->alignCenter()
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de actualización')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
