<?php

namespace Database\Seeders;

use App\Models\PerformanceCategory;
use Illuminate\Database\Seeder;

class PerformanceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Sangat Baik',
                'minimum_score' => 90,
                'maximum_score' => 100,
                'color' => 'success',
            ],
            [
                'category_name' => 'Baik',
                'minimum_score' => 80,
                'maximum_score' => 89.99,
                'color' => 'info',
            ],
            [
                'category_name' => 'Cukup',
                'minimum_score' => 70,
                'maximum_score' => 79.99,
                'color' => 'warning',
            ],
            [
                'category_name' => 'Perlu Peningkatan',
                'minimum_score' => 0,
                'maximum_score' => 69.99,
                'color' => 'danger',
            ],
        ];

        foreach ($categories as $category) {
            PerformanceCategory::updateOrCreate(
                ['category_name' => $category['category_name']],
                [
                    'minimum_score' => $category['minimum_score'],
                    'maximum_score' => $category['maximum_score'],
                    'color' => $category['color'],
                ]
            );
        }
    }
}
