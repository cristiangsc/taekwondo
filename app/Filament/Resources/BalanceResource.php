<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalanceResource\Pages;
use App\Models\Balance;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BalanceResource extends Resource
{
    protected static ?string $model = Balance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Balance General';
    protected static ?string $navigationGroup = 'Club';
    protected static ?int $navigationSort = 4;


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('anio')
                    ->label('Año')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo de Movimiento')
                    ->formatStateUsing(fn(?string $state): string => mb_strtoupper($state ?? '', 'UTF-8'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ingresos')
                    ->label('Ingresos')
                    ->numeric()
                    ->summarize([Sum::make()->label('Totales')->prefix('$ ')])
                    ->formatStateUsing(fn($state) => $state ? '$ ' . number_format($state, 0, ",", ".") : '-'),
                Tables\Columns\TextColumn::make('gastos')
                    ->label('Gastos')
                    ->numeric()
                    ->summarize([Sum::make()->label('Totales')->prefix('$ ')])
                    ->formatStateUsing(fn($state) => $state ? '$ ' . number_format($state, 0, ",", ".") : '-'),
                Tables\Columns\TextColumn::make('balance')
                    ->label('Balance')
                    ->numeric()
                    ->summarize([Sum::make()->label('Saldo')->prefix('$ ')])
                    ->prefix('$ ')
                    ->color(fn($state) => $state < 0 ? 'danger' : 'success'),
            ])
            ->modifyQueryUsing(function (Builder $query) {

                // Creamos una tabla temporal con la unión
                $tableName = 'balance_temp_' . time();
                // Primero, intentamos eliminar la tabla temporal si existe
                DB::statement("DROP TEMPORARY TABLE IF EXISTS {$tableName}");

                $sql = /** @lang text */
                    "CREATE TEMPORARY TABLE {$tableName} AS (
                            SELECT
                                anio,
                                tipo,
                                SUM(ingresos) as ingresos,
                                SUM(gastos) as gastos,
                                SUM(balance) as balance
                            FROM (
                                SELECT
                                    i.anio,
                                    ti.name as tipo,
                                    SUM(i.monto_ingreso) as ingresos,
                                    0 as gastos,
                                    SUM(i.monto_ingreso) as balance
                                FROM incomes i
                                INNER JOIN income_types ti ON i.income_type_id = ti.id
                                GROUP BY ti.name, i.anio

                                UNION ALL

                                SELECT
                                    g.anio,
                                    te.name as tipo,
                                    0 as ingresos,
                                    SUM(g.monto_gasto) as gastos,
                                    -SUM(g.monto_gasto) as balance
                                FROM expenses g
                                INNER JOIN expense_types te ON g.expense_type_id = te.id
                                GROUP BY te.name, g.anio
                            ) as combined
                            GROUP BY tipo, anio
                        )";

                DB::statement($sql);


                // Registramos una función de limpieza para eliminar la tabla temporal
                app()->terminating(function () use ($tableName) {
                    DB::statement("DROP TEMPORARY TABLE IF EXISTS {$tableName}");
                });

                // Modificamos la consulta original
                return $query->from($tableName)
                    ->select('*')
                    ->orderBy('tipo');
            })
            ->filters([
                SelectFilter::make('anio')
                    ->label('Año')
                    ->options(function () {
                        $aniosIngresos = DB::table('incomes')
                            ->select('anio')
                            ->distinct();
                        $aniosGastos = DB::table('expenses')
                            ->select('anio')
                            ->distinct();

                        return DB::query()
                            ->fromSub($aniosIngresos->union($aniosGastos), 'anios')
                            ->distinct()
                            ->orderByDesc('anio')
                            ->pluck('anio')
                            ->mapWithKeys(fn($anios) => [$anios => $anios]);
                    })
                    ->default(function () {
                        $aniosIngresos = DB::table('incomes')
                            ->select('anio')
                            ->distinct();
                        $aniosGastos = DB::table('expenses')
                            ->select('anio')
                            ->distinct();
                        $resultado = DB::query()
                            ->fromSub($aniosIngresos->union($aniosGastos), 'anios')
                            ->distinct()
                            ->orderByDesc('anio')
                            ->first();
                        return $resultado?->anio ?? date('Y');
                    })
            ])
            ->headerActions([
                Action::make('exportPdf')
                    ->label('Exportar PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($livewire) {
                        $records = $livewire->getFilteredTableQuery()->get();
                        $year = isset($livewire->tableFilters['anio']) ? current($livewire->tableFilters['anio']) : date('Y');
                        $pdf = Pdf::loadView('pdf.balance', [
                            'records' => $records,
                            'totales' => [
                                'ingresos' => $records->sum('ingresos'),
                                'gastos' => $records->sum('gastos'),
                                'balance' => $records->sum('balance'),
                            ],
                            'año' => $year
                        ])
                            ->setPaper('a4')
                            ->setOptions([
                                'isHtml5ParserEnabled' => true,
                                'isPhpEnabled' => true,
                                'isRemoteEnabled' => true,
                                'defaultFont' => 'Helvetica',
                                'chroot' => public_path(),
                                'enable_remote' => true,

                            ]);

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, 'balance-' . now()->format('Y-m-d') . '.pdf');
                    })
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBalances::route('/'),
        ];
    }
}
