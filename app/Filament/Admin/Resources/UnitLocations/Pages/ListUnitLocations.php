<?php

namespace App\Filament\Admin\Resources\UnitLocations\Pages;

use App\Filament\Admin\Resources\UnitLocations\UnitLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUnitLocations extends ListRecords
{
    protected static string $resource = UnitLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
