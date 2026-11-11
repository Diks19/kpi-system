<?php

namespace App\Filament\Resources\Positions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('position')
                    ->label('Jabatan')
                    ->placeholder('Operator')
                    ->columnSpan(2)
                    ->required(),
            ]);
    }
}
