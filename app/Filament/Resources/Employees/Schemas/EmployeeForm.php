<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nik')
                    ->label('NIK')
                    ->columnSpan(2)
                    ->unique(ignoreRecord: true)
                    ->placeholder('D0001')
                    ->required(),
                TextInput::make('name')
                    ->placeholder('John Doe')
                    ->label('Nama')
                    ->columnSpan(2)
                    ->required(),
                Select::make('department_id')
                    ->label('Departemen')
                    ->relationship('department', 'department')
                    ->preload()
                    ->searchable()
                    ->placeholder('Pilih Departemen')
                    ->searchPrompt('Cari Departemen...')
                    ->searchingMessage('Sedang mencari Departemen...')
                    ->noSearchResultsMessage('Departemen tidak ditemukan')
                    ->columnSpan(2)
                    ->required(),
                Select::make('position_id')
                    ->label('Jabatan')
                    ->relationship('position', 'position')
                    ->preload()
                    ->searchable()
                    ->placeholder('Pilih Jabatan')
                    ->searchPrompt('Cari Jabatan...')
                    ->searchingMessage('Sedang mencari Jabatan...')
                    ->noSearchResultsMessage('Jabatan tidak ditemukan')
                    ->columnSpan(2)
                    ->required(),
            ]);
    }
}
