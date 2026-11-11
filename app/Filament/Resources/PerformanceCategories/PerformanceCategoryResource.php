<?php

namespace App\Filament\Resources\PerformanceCategories;

use App\Filament\Resources\PerformanceCategories\Pages\CreatePerformanceCategory;
use App\Filament\Resources\PerformanceCategories\Pages\EditPerformanceCategory;
use App\Filament\Resources\PerformanceCategories\Pages\ListPerformanceCategories;
use App\Filament\Resources\PerformanceCategories\Schemas\PerformanceCategoryForm;
use App\Filament\Resources\PerformanceCategories\Tables\PerformanceCategoriesTable;
use App\Models\PerformanceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PerformanceCategoryResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Kinerja';

    protected static ?int $navigationSort = 2;

    protected static ?string $model = PerformanceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquaresPlus;

    protected static ?string $recordTitleAttribute = 'category_name';

    protected static ?string $modelLabel = 'Kategori Nilai';

    protected static ?string $pluralModelLabel = 'Kategori Nilai';

    protected static ?string $navigationLabel = 'Kategori Nilai';

    public static function form(Schema $schema): Schema
    {
        return PerformanceCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerformanceCategoriesTable::configure($table);
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
            'index' => ListPerformanceCategories::route('/'),
            'create' => CreatePerformanceCategory::route('/create'),
            'edit' => EditPerformanceCategory::route('/{record}/edit'),
        ];
    }
}
