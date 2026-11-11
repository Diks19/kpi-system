<?php

namespace App\Filament\Resources\PerformanceAppraisals;

use App\Filament\Resources\PerformanceAppraisals\Pages\CreatePerformanceAppraisal;
use App\Filament\Resources\PerformanceAppraisals\Pages\EditPerformanceAppraisal;
use App\Filament\Resources\PerformanceAppraisals\Pages\ListPerformanceAppraisals;
use App\Filament\Resources\PerformanceAppraisals\Schemas\PerformanceAppraisalForm;
use App\Filament\Resources\PerformanceAppraisals\Tables\PerformanceAppraisalsTable;
use App\Models\PerformanceAppraisal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PerformanceAppraisalResource extends Resource
{
    protected static ?string $model = PerformanceAppraisal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'PerformanceAppraisal';

    protected static ?string $modelLabel = 'Penilaian';

    protected static ?string $pluralModelLabel = 'Penilaian';

    protected static ?string $navigationLabel = 'Penilaian';

    public static function form(Schema $schema): Schema
    {
        return PerformanceAppraisalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerformanceAppraisalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPerformanceAppraisals::route('/'),
            'create' => CreatePerformanceAppraisal::route('/create'),
            'edit' => EditPerformanceAppraisal::route('/{record}/edit'),
        ];
    }
}
