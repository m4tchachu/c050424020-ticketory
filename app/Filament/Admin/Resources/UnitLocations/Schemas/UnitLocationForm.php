<?php

namespace App\Filament\Admin\Resources\UnitLocations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

            ]);
    }
}
