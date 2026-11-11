<?php

namespace App\Filament\Resources\KpiIndicators;

use App\Filament\Resources\KpiIndicators\Pages\CreateKpiIndicator;
use App\Filament\Resources\KpiIndicators\Pages\EditKpiIndicator;
use App\Filament\Resources\KpiIndicators\Pages\ListKpiIndicators;
use App\Filament\Resources\KpiIndicators\Schemas\KpiIndicatorForm;
use App\Filament\Resources\KpiIndicators\Tables\KpiIndicatorsTable;
use App\Models\KpiIndicator;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KpiIndicatorResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Kinerja';

    protected static ?int $navigationSort = 1;
    
    protected static ?string $model = KpiIndicator::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPresentationChartBar;

    protected static ?string $recordTitleAttribute = 'indicator_name';

    protected static ?string $modelLabel = 'Indikator KPI';

    protected static ?string $pluralModelLabel = 'Indikator KPI';

    protected static ?string $navigationLabel = 'Indikator KPI';

    public static function form(Schema $schema): Schema
    {
        return KpiIndicatorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KpiIndicatorsTable::configure($table);
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
            'index' => ListKpiIndicators::route('/'),
            'create' => CreateKpiIndicator::route('/create'),
            'edit' => EditKpiIndicator::route('/{record}/edit'),
        ];
    }
}
