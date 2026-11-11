<?php

namespace App\Exports;

use App\Models\KpiIndicator;
use App\Models\PerformanceAppraisal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PerformanceAppraisalsExport implements
  FromCollection,
  WithHeadings,
  WithMapping,
  WithStyles
{
  protected Collection $kpis;

  public function __construct()
  {
    $this->kpis = KpiIndicator::query()
      ->orderByDesc('weight')
      ->get();
  }

  public function collection(): Collection
  {
    return PerformanceAppraisal::query()
      ->with([
        'employee.department',
        'employee.position',
        'evaluator',
        'category',
        'details',
      ])
      ->orderByDesc('period')
      ->get();
  }

  public function headings(): array
  {
    $headings = [
      'NIK',
      'Nama Karyawan',
      'Departemen',
      'Jabatan',
      'Periode',
      'Penilai',
    ];

    foreach ($this->kpis as $kpi) {
      $headings[] = $kpi->indicator_name . ' - Nilai';
      $headings[] = $kpi->indicator_name . ' - Bobot (%)';
    }

    return array_merge($headings, [
      'Nilai Akhir',
      'Kategori',
    ]);
  }

  public function map($appraisal): array
  {
    $details = $appraisal->details->keyBy('kpi_id');

    $row = [
      $appraisal->employee?->nik,
      $appraisal->employee?->name,
      $appraisal->employee?->department?->department,
      $appraisal->employee?->position?->position,
      $appraisal->period?->format('F Y'),
      $appraisal->evaluator?->name,
    ];

    foreach ($this->kpis as $kpi) {
      $detail = $details->get($kpi->id_kpi);

      $row[] = $detail?->score;
      $row[] = $detail?->weight_snapshot;
    }

    return array_merge($row, [
      $appraisal->final_score,
      $appraisal->category?->category_name,
    ]);
  }

  public function styles(Worksheet $sheet): ?array
  {
    $lastColumn = Coordinate::stringFromColumnIndex(
      count($this->headings())
    );

    $lastRow = $sheet->getHighestRow();

    // Font default
    $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
      ->getFont()
      ->setName('Arial')
      ->setSize(10);

    // Header
    $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
      'font' => [
        'bold' => true,
        'color' => [
          'rgb' => 'FFFFFF',
        ],
        'size' => 10,
      ],
      'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
          'rgb' => '1F4E78',
        ],
      ],
      'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
        'wrapText' => true,
      ],
      'borders' => [
        'allBorders' => [
          'borderStyle' => Border::BORDER_THIN,
          'color' => [
            'rgb' => 'D9E2F3',
          ],
        ],
      ],
    ]);

    // Tinggi header
    $sheet->getRowDimension(1)->setRowHeight(35);

    if ($lastRow >= 2) {
      // Isi tabel
      $sheet->getStyle("A2:{$lastColumn}{$lastRow}")
        ->applyFromArray([
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
          ],
          'borders' => [
            'allBorders' => [
              'borderStyle' => Border::BORDER_THIN,
              'color' => [
                'rgb' => 'D9D9D9',
              ],
            ],
          ],
        ]);

      // Tinggi baris data
      for ($row = 2; $row <= $lastRow; $row++) {
        $sheet->getRowDimension($row)->setRowHeight(22);
      }
    }

    // Lebar kolom identitas
    $widths = [
      'A' => 16,
      'B' => 28,
      'C' => 22,
      'D' => 22,
      'E' => 18,
      'F' => 25,
    ];

    foreach ($widths as $column => $width) {
      $sheet->getColumnDimension($column)->setWidth($width);
    }

    // Lebar kolom KPI dinamis
    $columnIndex = 7;

    foreach ($this->kpis as $kpi) {
      $scoreColumn = Coordinate::stringFromColumnIndex($columnIndex);
      $weightColumn = Coordinate::stringFromColumnIndex($columnIndex + 1);

      $sheet->getColumnDimension($scoreColumn)->setWidth(18);
      $sheet->getColumnDimension($weightColumn)->setWidth(18);

      $columnIndex += 2;
    }

    // Kolom nilai akhir dan kategori
    $sheet->getColumnDimension($lastColumn)->setWidth(20);

    $categoryColumn = Coordinate::stringFromColumnIndex(
      count($this->headings())
    );

    $sheet->getColumnDimension($categoryColumn)->setWidth(22);

    // Freeze header dan aktifkan filter
    $sheet->freezePane('A2');
    $sheet->setAutoFilter("A1:{$lastColumn}{$lastRow}");

    return null;
  }
}
