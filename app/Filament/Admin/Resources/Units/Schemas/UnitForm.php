<?php

namespace App\Filament\Admin\Resources\Units\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                // TextInput::make('unit_location_id')
                //     ->required()
                //     ->numeric(),
                Select::make('unit_location_id')
                    ->label('Lokasi Unit')
                    ->relationship('location', 'name')
                    ->required(),
            ]);
    }
}
