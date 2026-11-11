<?php

namespace App\Filament\Resources\PerformanceAppraisals\Pages;

use App\Filament\Resources\PerformanceAppraisals\PerformanceAppraisalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerformanceAppraisal extends EditRecord
{
    protected static string $resource = PerformanceAppraisalResource::class;

    protected static ?string $breadcrumb = 'Ubah Penilaian';

    protected static ?string $title = 'Ubah Penilaian';

    protected function deletedNotificationTitle(): ?string
    {
        return 'Penilaian berhasil dihapus';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Penilaian berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Penilaian')
                ->modalHeading('Hapus Penilaian')
                ->successNotificationTitle('Penilaian berhasil dihapus')
                ->modalDescription('Apakah kamu yakin ingin menghapus Penilaian ini? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->modalCancelActionLabel('Batal'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Simpan Perubahan'),

            $this->getCancelFormAction()
                ->label('Batal'),
        ];
    }
}
