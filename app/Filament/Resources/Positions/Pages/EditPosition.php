<?php

namespace App\Filament\Resources\Positions\Pages;

use App\Filament\Resources\Positions\PositionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPosition extends EditRecord
{
    protected static string $resource = PositionResource::class;

    protected static ?string $breadcrumb = 'Ubah Jabatan';

    protected static ?string $title = 'Ubah Jabatan';

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Jabatan berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus Jabatan')
                ->successNotificationTitle('Jabatan berhasil dihapus')
                ->modalHeading('Hapus Jabatan')
                ->modalDescription('Apakah kamu yakin ingin menghapus jabatan ini? Tindakan ini tidak dapat dibatalkan.')
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
