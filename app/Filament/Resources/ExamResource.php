<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Exámenes';
    protected static ?string $breadcrumb = 'Exámenes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Estudiante')
                    ->relationship('student', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('exam_date')
                    ->label('Fecha del examen')
                    ->required(),
                Forms\Components\Select::make('previous_grade_id')
                    ->label('Grado anterior')
                    ->relationship('previousGrade', 'name')
                    ->required(),
                Forms\Components\Select::make('current_grade_id')
                    ->label('Grado actual')
                    ->relationship('currentGrade', 'name')
                    ->default(null),
                Forms\Components\Select::make('result')
                    ->label('Resultado')
                    ->options([
                        'Aprobado' => 'Aprobado',
                        'Reprobado' => 'Reprobado',
                        'Pendiente' => 'Pendiente',
                    ]),
                Forms\Components\TextInput::make('score')
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
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Estudiante')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_date')
                    ->label('Fecha del examen')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('previousGrade.name')
                    ->label('Grado anterior')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currentGrade.name')
                    ->label('Grado actual')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('result')
                    ->label('Resultado'),
                Tables\Columns\TextColumn::make('score')
                    ->label('Puntaje')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado en')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado en')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('exam_date', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar examen'),
                Tables\Actions\DeleteAction::make()
                    ->label('Eliminar examen')
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
