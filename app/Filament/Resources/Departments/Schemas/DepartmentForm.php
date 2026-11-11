<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('department')
                    ->label('Departemen')
                    ->placeholder('Produksi')
                    ->columnSpan(2)
                    ->required(),
            ]);
    }
}
