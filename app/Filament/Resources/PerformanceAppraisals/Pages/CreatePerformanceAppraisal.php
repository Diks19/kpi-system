<?php

namespace App\Filament\Resources\PerformanceAppraisals\Pages;

use App\Filament\Resources\PerformanceAppraisals\PerformanceAppraisalResource;
use App\Models\PerformanceCategory;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreatePerformanceAppraisal extends CreateRecord
{
    protected static string $resource = PerformanceAppraisalResource::class;

    protected static ?string $title = 'Tambah Penilaian';

    protected static ?string $breadcrumb = 'Tambah Penilaian';

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Penilaian berhasil ditambahkan';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan Penilaian'),

            $this->getCreateAnotherFormAction()
                ->label('Simpan & Tambah Lagi'),

            $this->getCancelFormAction()
                ->label('Batal'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $details = $this->data['details'] ?? [];

        if (empty($details)) {
            throw ValidationException::withMessages([
                'data.details' => 'Minimal harus ada satu indikator KPI.',
            ]);
        }

        $totalWeight = 0;
        $totalScore = 0;

        foreach ($details as $detail) {
            $weight = (float) ($detail['weight_snapshot'] ?? 0);
            $score = (float) ($detail['score'] ?? 0);

            $totalWeight += $weight;
            $totalScore += $score * $weight;
        }

        if ($totalWeight <= 0) {
            throw ValidationException::withMessages([
                'data.details' => 'Total bobot KPI harus lebih besar dari 0.',
            ]);
        }

        $finalScore = round($totalScore / $totalWeight, 2);

        $category = PerformanceCategory::query()
            ->where('minimum_score', '<=', $finalScore)
            ->where('maximum_score', '>=', $finalScore)
            ->first();

        if (!$category) {
            throw ValidationException::withMessages([
                'data.details' => "Tidak ditemukan kategori untuk nilai akhir {$finalScore}.",
            ]);
        }

        $data['final_score'] = $finalScore;
        $data['category_id'] = $category->id_category;

        return $data;
    }
}
