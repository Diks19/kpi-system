<?php

namespace App\Filament\Resources\PerformanceAppraisals\Pages;

use App\Filament\Resources\PerformanceAppraisals\PerformanceAppraisalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerformanceAppraisals extends ListRecords
{
    protected static string $resource = PerformanceAppraisalResource::class;

    protected static ?string $breadcrumb = 'List Penilaian';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Penilaian'),
        ];
    }
}
