<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use App\Models\PerformanceAppraisal;
use App\Models\PerformanceCategory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KpiOverview extends BaseWidget
{
  protected static ?int $sort = 1;

  protected function getStats(): array
  {
    $totalEmployees = Employee::count();
    $totalAppraisals = PerformanceAppraisal::count();
    $averageScore = PerformanceAppraisal::avg('final_score');

    $topCategory = PerformanceCategory::query()
      ->withCount('performanceAppraisals')
      ->orderByDesc('performance_appraisals_count')
      ->first();

    return [
      Stat::make('Total Karyawan', number_format($totalEmployees))
        ->description('Seluruh karyawan terdaftar')
        ->descriptionIcon('heroicon-m-users')
        ->color('primary'),

      Stat::make('Total Penilaian', number_format($totalAppraisals))
        ->description('Seluruh penilaian kinerja')
        ->descriptionIcon('heroicon-m-clipboard-document-check')
        ->color('info'),

      Stat::make(
        'Rata-rata Nilai',
        $averageScore !== null
          ? number_format((float) $averageScore, 2)
          : '0.00'
      )
        ->description('Rata-rata seluruh nilai akhir')
        ->descriptionIcon('heroicon-m-chart-bar')
        ->color('success'),

      Stat::make(
        'Kategori Terbanyak',
        $topCategory && $topCategory->performance_appraisals_count > 0
          ? $topCategory->category_name
          : 'Belum ada'
      )
        ->description(
          $topCategory && $topCategory->performance_appraisals_count > 0
            ? number_format($topCategory->performance_appraisals_count) . ' penilaian'
            : 'Belum ada data penilaian'
        )
        ->descriptionIcon('heroicon-m-trophy')
        ->color('warning'),
    ];
  }
}
