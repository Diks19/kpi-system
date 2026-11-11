<?php

namespace App\Filament\Widgets;

use App\Models\PerformanceAppraisal;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAppraisals extends BaseWidget
{
  protected static ?int $sort = 4;

  protected int|string|array $columnSpan = 'full';

  protected function getTableHeading(): ?string
  {
    return 'Penilaian Terbaru';
  }

  public function table(Table $table): Table
  {
    return $table
      ->query(
        PerformanceAppraisal::query()
          ->with(['employee', 'category', 'evaluator'])
          ->latest('period')
          ->latest('created_at')
          ->limit(5)
      )
      ->columns([
        TextColumn::make('employee.name')
          ->label('Nama Karyawan')
          ->searchable(),

        TextColumn::make('period')
          ->label('Periode')
          ->date('F Y'),

        TextColumn::make('final_score')
          ->label('Nilai Akhir')
          ->numeric(decimalPlaces: 2),

        TextColumn::make('category.category_name')
          ->label('Kategori')
          ->badge()
          ->color(fn($record) => $record->category?->color ?? 'gray'),

        TextColumn::make('evaluator.name')
          ->label('Penilai'),
      ])
      ->paginated(false)
      ->emptyStateHeading('Belum ada penilaian')
      ->emptyStateDescription('Data penilaian akan muncul di sini.');
  }
}
