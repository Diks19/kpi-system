<?php

namespace App\Filament\Resources\KpiIndicators\Pages;

use App\Filament\Resources\KpiIndicators\KpiIndicatorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKpiIndicators extends ListRecords
{
    protected static string $resource = KpiIndicatorResource::class;

    protected static ?string $breadcrumb = 'List Indikator KPI';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Indikator KPI'),
        ];
    }
}
