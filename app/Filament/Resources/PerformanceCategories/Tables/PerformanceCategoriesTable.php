<?php

namespace App\Filament\Resources\PerformanceCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PerformanceCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category_name')
                    ->label('Kategori Nilai')
                    ->searchable(),
                TextColumn::make('minimum_score')
                    ->label('Nilai Minimum')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('maximum_score')
                    ->label('Nilai Maksimum')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada Kategori Nilai')
            ->emptyStateDescription('Silakan tambahkan Kategori Nilai untuk mulai mengelola data.')
            ->emptyStateIcon('heroicon-o-squares-plus');
    }
}
