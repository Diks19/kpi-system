<?php

namespace App\Filament\Resources\PerformanceCategories\Pages;

use App\Filament\Resources\PerformanceCategories\PerformanceCategoryResource;
use App\Support\PerformanceCategoryValidator;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerformanceCategory extends EditRecord
{
    protected static string $resource = PerformanceCategoryResource::class;

    protected static ?string $breadcrumb = 'Ubah Kategori Penilaian';

    protected static ?string $title = 'Ubah Kategori Penilaian';

    protected function beforeSave(): void
    {
        PerformanceCategoryValidator::validate(
            $this->data,
            $this->getRecord()
        );
    }

    protected function deletedNotificationTitle(): ?string
    {
        return 'Kategori Penilaian berhasil dihapus';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Kategori Penilaian berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Kategori Penilaian')
                ->modalHeading('Hapus Kategori Penilaian')
                ->successNotificationTitle('Kategori Penilaian berhasil dihapus')
                ->modalDescription('Apakah kamu yakin ingin menghapus Kategori Penilaian ini? Tindakan ini tidak dapat dibatalkan.')
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
