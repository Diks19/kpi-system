<?php

namespace App\Filament\Resources\PerformanceCategories\Pages;

use App\Filament\Resources\PerformanceCategories\PerformanceCategoryResource;
use App\Support\PerformanceCategoryValidator;
use Filament\Resources\Pages\CreateRecord;

class CreatePerformanceCategory extends CreateRecord
{
    protected static string $resource = PerformanceCategoryResource::class;

    protected static ?string $title = 'Tambah Kategori Penilaian';

    protected static ?string $breadcrumb = 'Tambah Kategori Penilaian';

    protected function beforeCreate(): void
    {
        PerformanceCategoryValidator::validate($this->data);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Kategori Penilaian berhasil ditambahkan';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan Kategori Penilaian'),

            $this->getCreateAnotherFormAction()
                ->label('Simpan & Tambah Lagi'),

            $this->getCancelFormAction()
                ->label('Batal'),
        ];
    }
}
