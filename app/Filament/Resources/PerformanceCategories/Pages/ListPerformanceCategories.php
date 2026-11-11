<?php

namespace App\Filament\Resources\PerformanceCategories\Pages;

use App\Filament\Resources\PerformanceCategories\PerformanceCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerformanceCategories extends ListRecords
{
    protected static string $resource = PerformanceCategoryResource::class;

    protected static ?string $breadcrumb = 'List Kategori Penilaian';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Kategori Penilaian'),
        ];
    }
}
