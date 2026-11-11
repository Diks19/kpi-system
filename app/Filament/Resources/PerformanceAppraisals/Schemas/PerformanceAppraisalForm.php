<?php

namespace App\Filament\Resources\PerformanceAppraisals\Schemas;

use App\Models\Employee;
use App\Models\KpiIndicator;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PerformanceAppraisalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('nik_id')
                ->label('Karyawan')
                ->options(
                    Employee::query()->pluck('name', 'nik')
                )
                ->searchable()
                ->placeholder('Pilih Karyawan')
                ->searchPrompt('Cari Karyawan...')
                ->searchingMessage('Sedang mencari Karyawan...')
                ->noSearchResultsMessage('Karyawan tidak ditemukan')
                ->preload()
                ->columnSpan(2)
                ->required(),

            Hidden::make('evaluator_id')
                ->default(auth()->id())
                ->required(),

            DatePicker::make('period')
                ->label('Periode Penilaian')
                ->placeholder('Januari 2026')
                ->native(false)
                ->displayFormat('F Y')
                ->format('Y-m-d')
                ->closeOnDateSelection()
                ->columnSpan(2)
                ->required(),

            Repeater::make('details')
                ->label('Penilaian Indikator KPI')
                ->relationship()
                ->columnSpan(2)
                ->schema([
                    Hidden::make('kpi_id'),

                    TextInput::make('indicator_name')
                        ->label('Indikator KPI')
                        ->formatStateUsing(
                            fn($record) => $record?->kpiIndicator?->indicator_name
                        )
                        ->disabled()
                        ->dehydrated(false),

                    Hidden::make('weight_snapshot'),

                    TextInput::make('score')
                        ->label('Nilai')
                        ->numeric()
                        ->step(0.01)
                        ->minValue(0)
                        ->maxValue(100)
                        ->suffix('/ 100')
                        ->required(),
                ])
                ->default(
                    KpiIndicator::query()
                        ->get()
                        ->map(fn($indicator) => [
                            'kpi_id' => $indicator->id_kpi,
                            'indicator_name' => $indicator->indicator_name,
                            'weight_snapshot' => $indicator->weight,
                        ])
                        ->toArray()
                )
                ->addable(false)
                ->deletable(false)
                ->reorderable(false)
                ->columns(2)
                ->required()

        ]);
    }
}
