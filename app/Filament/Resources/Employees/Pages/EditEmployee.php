<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected static ?string $breadcrumb = 'Ubah Karyawan';

    protected static ?string $title = 'Ubah Karyawan';

    protected function deletedNotificationTitle(): ?string
    {
        return 'Karyawan berhasil dihapus';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Karyawan berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Karyawan')
                ->modalHeading('Hapus Karyawan')
                ->successNotificationTitle('Karyawan berhasil dihapus')
                ->modalDescription('Apakah kamu yakin ingin menghapus Karyawan ini? Tindakan ini tidak dapat dibatalkan.')
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
