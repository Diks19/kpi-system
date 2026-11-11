<?php

namespace App\Filament\Resources\Employees\Tables;

use App\Imports\EmployeesImport;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\ExportAction;
use App\Exports\EmployeesExcelExport;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama Karyawan')
                    ->searchable(),

                TextColumn::make('department.department')
                    ->label('Departemen')
                    ->searchable(),

                TextColumn::make('position.position')
                    ->label('Jabatan')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Action::make('import')
                    ->label('Import Excel')
                    ->icon('heroicon-o-document-arrow-up')
                    ->color('success')
                    ->schema([
                        FileUpload::make('file')
                            ->label('File Excel')
                            ->disk('local')
                            ->directory('imports')
                            ->visibility('private')
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $import = new EmployeesImport();

                        Excel::import(
                            $import,
                            Storage::disk('local')->path($data['file'])
                        );

                        $failures = $import->failures();

                        if ($failures->isNotEmpty()) {
                            $messages = $failures
                                ->take(5)
                                ->map(
                                    fn($failure) =>
                                    'Baris ' . $failure->row() . ': ' .
                                        implode(', ', $failure->errors())
                                )
                                ->implode("\n");

                            Notification::make()
                                ->warning()
                                ->title('Import selesai dengan beberapa kegagalan')
                                ->body(
                                    $failures->count() . ' baris gagal diimpor.'
                                        . "\n" . $messages
                                )
                                ->persistent()
                                ->send();

                            return;
                        }

                        Notification::make()
                            ->success()
                            ->title('Import berhasil')
                            ->body('Seluruh data karyawan berhasil diimpor.')
                            ->send();
                    }),

                ExportAction::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('primary')
                    ->exports([
                        EmployeesExcelExport::make('karyawan'),
                    ]),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada karyawan')
            ->emptyStateDescription(
                'Silakan tambahkan karyawan untuk mulai mengelola data.'
            )
            ->emptyStateIcon('heroicon-o-building-office-2');
    }
}
