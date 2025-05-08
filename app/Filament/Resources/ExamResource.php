<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Exámenes';
    protected static ?string $breadcrumb = 'Exámenes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->prefixIcon('heroicon-o-user')
                    ->label('Estudiante')
                    ->relationship('student', 'full_name')
                    ->required(),
                Forms\Components\DatePicker::make('exam_date')
                    ->prefixIcon('heroicon-o-calendar')
                    ->label('Fecha del examen')
                    ->required(),
                Forms\Components\Select::make('previous_grade_id')
                    ->prefixIcon('hugeicons-square-arrow-move-right-down')
                    ->label('Grado actual')
                    ->relationship('previousGrade', 'name')
                    ->required(),
                Forms\Components\Select::make('current_grade_id')
                    ->prefixIcon('hugeicons-square-arrow-move-right-down')
                    ->label('Grado al que postula')
                    ->relationship('currentGrade', 'name')
                    ->default(null),
                Forms\Components\Select::make('result')
                    ->prefixIcon('heroicon-o-check-circle')
                    ->label('Resultado')
                    ->options([
                        'Aprobado' => 'Aprobado',
                        'Reprobado' => 'Reprobado',
                        'Pendiente' => 'Pendiente',
                    ]),
                Forms\Components\TextInput::make('score')
                    ->prefixIcon('heroicon-o-check-circle')
                    ->label('Puntaje')
                    ->numeric()
                    ->default(null),
                Forms\Components\Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Estudiante')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_date')
                    ->icon('heroicon-o-calendar')
                    ->label('Fecha del examen')
                    ->date()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('previousGrade.name')
                    ->label('Grado actual')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currentGrade.name')
                    ->label('Grado al que postula')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('result')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aprobado' => 'info',
                        'Reprobado' => 'success',
                        'Pendiente' => 'warning',
                    })
                    ->label('Resultado')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('score')
                    ->label('Puntaje')
                    ->badge()
                    ->color(fn ($state): string => $state < 4 ? 'danger' : 'info')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado en')
                    ->dateTime()
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado en')
                    ->dateTime()
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('exam_date', 'desc')
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
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
