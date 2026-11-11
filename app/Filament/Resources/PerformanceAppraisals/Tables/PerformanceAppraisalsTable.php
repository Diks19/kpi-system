<?php

namespace App\Filament\Resources\PerformanceAppraisals\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class PerformanceAppraisalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->url(route('performance-appraisals.export')),
            ])
            ->columns([
                TextColumn::make('employee.name')
                    ->label('Nama Karyawan')
                    ->searchable(),
                TextColumn::make('period')
                    ->label('Periode')
                    ->date('F Y')
                    ->sortable(),
                TextColumn::make('final_score')
                    ->label('Nilai Akhir')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                TextColumn::make('category.category_name')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn($record) => $record->category?->color ?? 'gray'),
                TextColumn::make('evaluator.name')
                    ->label('Penilai'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('period', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Detail')
                    ->schema([
                        Section::make('Informasi Penilaian')
                            ->schema([
                                TextEntry::make('employee.name')
                                    ->label('Karyawan'),

                                TextEntry::make('period')
                                    ->label('Periode')
                                    ->date('F Y'),

                                TextEntry::make('final_score')
                                    ->label('Nilai Akhir')
                                    ->numeric(decimalPlaces: 2),

                                TextEntry::make('category.category_name')
                                    ->label('Kategori')
                                    ->badge()
                                    ->color(fn($record) => $record->category?->color ?? 'gray'),
                            ])
                            ->columns(2),

                        Section::make('Rincian KPI')
                            ->schema([
                                RepeatableEntry::make('details')
                                    ->hiddenLabel()
                                    ->schema([
                                        TextEntry::make('kpiIndicator.indicator_name')
                                            ->label('Indikator')
                                            ->weight('bold'),

                                        TextEntry::make('weight_snapshot')
                                            ->label('Bobot')
                                            ->suffix('%'),

                                        TextEntry::make('score')
                                            ->label('Nilai')
                                            ->suffix('/100'),
                                    ])
                                    ->columns(3),
                            ]),
                    ]),

                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada Penilaian')
            ->emptyStateDescription('Silakan tambahkan Penilaian untuk mulai mengelola data.')
            ->emptyStateIcon('heroicon-o-clipboard-document-check');
    }
}
