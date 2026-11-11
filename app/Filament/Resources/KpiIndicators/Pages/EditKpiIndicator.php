<?php

namespace App\Filament\Resources\KpiIndicators\Pages;

use App\Filament\Resources\KpiIndicators\KpiIndicatorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKpiIndicator extends EditRecord
{
    protected static string $resource = KpiIndicatorResource::class;

    protected static ?string $breadcrumb = 'Ubah Indikator KPI';

    protected static ?string $title = 'Ubah Indikator KPI';

    protected function deletedNotificationTitle(): ?string
    {
        return 'Indikator KPI berhasil dihapus';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Indikator KPI berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Indikator KPI')
                ->modalHeading('Hapus Indikator KPI')
                ->successNotificationTitle('Indikator KPI berhasil dihapus')
                ->modalDescription('Apakah kamu yakin ingin menghapus Indikator KPI ini? Tindakan ini tidak dapat dibatalkan.')
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
