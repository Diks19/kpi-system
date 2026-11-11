<?php

namespace App\Filament\Widgets;

use App\Models\PerformanceCategory;
use Filament\Widgets\ChartWidget;

class KpiCategoryChart extends ChartWidget
{
  protected static ?int $sort = 2;

  protected ?string $heading = 'Distribusi Hasil Penilaian';

  protected ?string $maxHeight = '300px';

  protected ?string $pollingInterval = null;

  protected function getOptions(): array
  {
    return [
      'aspectRatio' => 1.5,
    ];
  }

  protected function getData(): array
  {
    $categories = PerformanceCategory::query()
      ->withCount('performanceAppraisals')
      ->get()
      ->filter(fn($category) => $category->performance_appraisals_count > 0);

    return [
      'datasets' => [
        [
          'label' => 'Jumlah Penilaian',
          'data' => $categories
            ->pluck('performance_appraisals_count')
            ->values()
            ->all(),
        ],
      ],
      'labels' => $categories
        ->pluck('category_name')
        ->values()
        ->all(),
    ];
  }

  protected function getType(): string
  {
    return 'doughnut';
  }
}
