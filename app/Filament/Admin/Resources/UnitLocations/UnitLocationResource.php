<?php

namespace App\Filament\Admin\Resources\UnitLocations;

use App\Filament\Admin\Resources\UnitLocations\Pages\CreateUnitLocation;
use App\Filament\Admin\Resources\UnitLocations\Pages\EditUnitLocation;
use App\Filament\Admin\Resources\UnitLocations\Pages\ListUnitLocations;
use App\Filament\Admin\Resources\UnitLocations\Schemas\UnitLocationForm;
use App\Filament\Admin\Resources\UnitLocations\Tables\UnitLocationsTable;
use App\Models\UnitLocation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UnitLocationResource extends Resource
{
    protected static ?string $model = UnitLocation::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;
    protected static ?string $navigationLabel = 'Lokasi Unit';

    public static function form(Schema $schema): Schema
    {
        return UnitLocationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnitLocationsTable::configure($table);
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
            'index' => ListUnitLocations::route('/'),
            'create' => CreateUnitLocation::route('/create'),
            'edit' => EditUnitLocation::route('/{record}/edit'),
        ];
    }
}
