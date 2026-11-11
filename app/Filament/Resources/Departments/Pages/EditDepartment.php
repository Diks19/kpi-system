<?php

namespace App\Filament\Resources\Departments\Pages;

use App\Filament\Resources\Departments\DepartmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected static ?string $breadcrumb = 'Ubah Departemen';

    protected static ?string $title = 'Ubah Departemen';

    protected function deletedNotificationTitle(): ?string
    {
        return 'Departemen berhasil dihapus';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Departemen berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Departemen')
                ->modalHeading('Hapus Departemen')
                ->successNotificationTitle('Departemen berhasil dihapus')
                ->modalDescription('Apakah kamu yakin ingin menghapus departemen ini? Tindakan ini tidak dapat dibatalkan.')
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
