<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'Produksi',
            'TQC',
            'HR',
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate([
                'department' => $department,
            ]);
        }
    }
}
