<?php

namespace Database\Seeders;

use App\Models\KpiIndicator;
use Illuminate\Database\Seeder;

class KpiIndicatorSeeder extends Seeder
{
    public function run(): void
    {
        $indicators = [
            [
                'indicator_name' => 'Produktivitas',
                'weight' => 40,
            ],
            [
                'indicator_name' => 'Kualitas Kerja',
                'weight' => 35,
            ],
            [
                'indicator_name' => 'Disiplin/Ketepatan Waktu',
                'weight' => 25,
            ],
        ];

        foreach ($indicators as $indicator) {
            KpiIndicator::updateOrCreate(
                ['indicator_name' => $indicator['indicator_name']],
                ['weight' => $indicator['weight']]
            );
        }
    }
}
