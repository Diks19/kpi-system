<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            'Operator',
            'Staff',
        ];

        foreach ($positions as $position) {
            Position::firstOrCreate([
                'position' => $position,
            ]);
        }
    }
}
