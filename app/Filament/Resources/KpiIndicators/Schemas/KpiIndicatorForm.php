<?php

namespace App\Filament\Resources\KpiIndicators\Schemas;

use App\Models\KpiIndicator;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KpiIndicatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('indicator_name')
                    ->label('Indikator KPI')
                    ->placeholder('Produktivitas')
                    ->columnSpan(2)
                    ->required(),
                TextInput::make('weight')
                    ->label('Bobot (%)')
                    ->placeholder("20")
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(function (?KpiIndicator $record) {
                        $totalWeight = KpiIndicator::sum('weight');

                        if ($record) {
                            $totalWeight -= $record->weight;
                        }

                        return 100 - $totalWeight;
                    })
                    ->afterStateUpdated(function ($state, $set) {
                        if (is_numeric($state) && (float) $state > 100) {
                            $set('weight', 100);
                        }
                    })
                    ->suffix('%')
                    ->columnSpan(2)
                    ->required(),
            ]);
    }
}
