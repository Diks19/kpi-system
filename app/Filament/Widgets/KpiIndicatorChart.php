<?php

namespace App\Filament\Widgets;

use App\Models\KpiIndicator;
use Filament\Widgets\ChartWidget;

class KpiIndicatorChart extends ChartWidget
{
  protected static ?int $sort = 3;

  protected ?string $heading = 'Rata-rata Nilai Indikator KPI';

  protected ?string $maxHeight = '300px';

  protected ?string $pollingInterval = null;

  protected function getData(): array
  {
    $indicators = KpiIndicator::query()
      ->withAvg('appraisalDetails', 'score')
      ->get();

    return [
      'datasets' => [
        [
          'label' => 'Rata-rata Nilai',
          'data' => $indicators
            ->map(fn($indicator) => round(
              (float) ($indicator->appraisal_details_avg_score ?? 0),
              2
            ))
            ->values()
            ->all(),
        ],
      ],
      'labels' => $indicators
        ->pluck('indicator_name')
        ->values()
        ->all(),
    ];
  }

  protected function getType(): string
  {
    return 'bar';
  }

  protected function getOptions(): array
  {
    return [
      'scales' => [
        'y' => [
          'beginAtZero' => true,
          'max' => 100,
        ],
      ],
      'aspectRatio' => 1.5,
    ];
  }
}
