<?php

namespace App\Filament\Resources\KpiIndicators\Pages;

use App\Filament\Resources\KpiIndicators\KpiIndicatorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKpiIndicator extends CreateRecord
{
    protected static string $resource = KpiIndicatorResource::class;

    protected static ?string $title = 'Tambah Indikator KPI';

    protected static ?string $breadcrumb = 'Tambah Indikator KPI';

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Indikator KPI berhasil ditambahkan';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan Indikator KPI'),

            $this->getCreateAnotherFormAction()
                ->label('Simpan & Tambah Lagi'),

            $this->getCancelFormAction()
                ->label('Batal'),
        ];
    }
}
