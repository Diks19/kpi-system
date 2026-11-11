<?php

namespace App\Filament\Resources\PerformanceCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PerformanceCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('category_name')
                    ->label('Kategori Nilai')
                    ->columnSpan(2)
                    ->placeholder('Sangat Baik')
                    ->required(),

                TextInput::make('minimum_score')
                    ->label('Nilai Minimum')
                    ->placeholder('80')
                    ->columnSpan(2)
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),

                TextInput::make('maximum_score')
                    ->label('Nilai Maksimum')
                    ->placeholder('89.99')
                    ->columnSpan(2)
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
                Select::make('color')
                    ->label('Warna Badge')
                    ->options([
                        'primary' => 'Primary',
                        'success' => 'Success',
                        'danger' => 'Danger',
                        'warning' => 'Warning',
                        'info' => 'Info',
                        'gray' => 'Gray',
                    ])
                    ->required()
                    ->default('gray'),
            ])
            ->columns(2);
    }
}
