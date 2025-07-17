<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquipmentResource\Pages;
use App\Models\Equipment;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Equipamiento';
    protected static ?string $modelLabel = 'Equipo';
    protected static ?string $pluralModelLabel = 'Equipos';
    protected static ?string $navigationGroup = 'Inventario';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Básica')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('code')
                            ->label('Código')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('category_id')
                            ->label('Categoría')
                            ->relationship('category', 'name')
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nombre')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Descripción'),
                            ]),
                        Forms\Components\Textarea::make('description')
                            ->label('Descripción')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Detalles del Producto')
                    ->schema([
                        Forms\Components\TextInput::make('size')
                            ->label('Talla/Tamaño')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('color')
                            ->label('Color')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('brand')
                            ->label('Marca')
                            ->maxLength(255),
                        Forms\Components\Select::make('condition')
                            ->label('Condición')
                            ->options([
                                'excelente' => 'Excelente',
                                'bueno' => 'Bueno',
                                'regular' => 'Regular',
                                'malo' => 'Malo',
                            ])
                            ->default('excelente')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'disponible' => 'Disponible',
                                'prestado' => 'Prestado',
                                'en_mantenimiento' => 'En Mantenimiento',
                                'perdido' => 'Perdido',
                                'dañado' => 'Dañado',
                            ])
                            ->default('disponible')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Información de Compra')
                    ->schema([
                        Forms\Components\TextInput::make('purchase_price')
                            ->label('Precio de Compra')
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\DatePicker::make('purchase_date')
                            ->label('Fecha de Compra'),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notas')
                            ->rows(3)
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('imagen')
                            ->label('Imagen')
                            ->collection('implemento')
                            ->image()
                            ->responsiveImages()
                            ->imageEditor()
                            ->openable()
                            ->optimize('jpg')
                            ->columnSpanFull()
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('size')
                    ->label('Talla')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('color')
                    ->label('Color')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('condition')
                    ->label('Condición')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'excelente' => 'Excelente',
                        'bueno' => 'Bueno',
                        'regular' => 'Regular',
                        'malo' => 'Malo',
                        default => $state
                    })
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'excelente' => 'success',
                        'bueno' => 'primary',
                        'regular' => 'warning',
                        'malo' => 'danger',
                        default => 'secondary'
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'disponible' => 'Disponible',
                        'prestado' => 'Prestado',
                        'en_mantenimiento' => 'En Mantenimiento',
                        'perdido' => 'Perdido',
                        'dañado' => 'Dañado',
                        default => $state
                    })
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'disponible' => 'success',
                        'prestado' => 'warning',
                        'en_mantenimiento' => 'info',
                        'perdido' => 'danger',
                        'dañado' => 'danger',
                        default => 'secondary'
                    }),
                Tables\Columns\TextColumn::make('purchase_price')
                    ->label('Precio')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('purchase_date')
                    ->label('Fecha Compra')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'disponible' => 'Disponible',
                        'prestado' => 'Prestado',
                        'en_mantenimiento' => 'En Mantenimiento',
                        'perdido' => 'Perdido',
                        'dañado' => 'Dañado',
                    ]),
                Tables\Filters\SelectFilter::make('condition')
                    ->label('Condición')
                    ->options([
                        'excelente' => 'Excelente',
                        'bueno' => 'Bueno',
                        'regular' => 'Regular',
                        'malo' => 'Malo',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
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
            'index' => Pages\ListEquipment::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'view' => Pages\ViewEquipment::route('/{record}'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}
