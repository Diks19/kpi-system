<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class EmployeesExcelExport extends ExcelExport implements WithStyles
{
  public function setUp()
  {
    $this->withFilename(
      'data-karyawan-' . now()->format('Y-m-d')
    );

    $this->withColumns([
      Column::make('nik')
        ->heading('NIK'),

      Column::make('name')
        ->heading('Nama Karyawan'),

      Column::make('department.department')
        ->heading('Departemen'),

      Column::make('position.position')
        ->heading('Jabatan'),
    ]);

    $this->modifyQueryUsing(
      fn($query) => $query->with([
        'department',
        'position',
      ])
    );
  }

  public function styles(Worksheet $sheet): array
  {
    $lastColumn = $sheet->getHighestColumn();
    $lastRow = $sheet->getHighestRow();

    // Font seluruh tabel
    $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
      ->getFont()
      ->setName('Arial')
      ->setSize(10);

    // Styling header
    $sheet->getStyle("A1:{$lastColumn}1")
      ->applyFromArray([
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

    $sheet->getRowDimension(1)->setRowHeight(30);

    if ($lastRow >= 2) {
      // Styling seluruh isi
      $sheet->getStyle("A2:{$lastColumn}{$lastRow}")
        ->applyFromArray([
          'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
            'wrapText' => true,
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

      for ($row = 2; $row <= $lastRow; $row++) {
        $sheet->getRowDimension($row)->setRowHeight(22);
      }
    }

    // Lebar kolom
    $widths = [
      'A' => 18,
      'B' => 30,
      'C' => 24,
      'D' => 24,
    ];

    foreach ($widths as $column => $width) {
      $sheet->getColumnDimension($column)->setWidth($width);
    }

    // Freeze header dan filter
    $sheet->freezePane('A2');
    $sheet->setAutoFilter("A1:{$lastColumn}{$lastRow}");

    return [];
  }
}
