<?php

namespace App\Filament\Admin\Resources\Technicians\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TechnicianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user','name')
                    ->searchable()
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category','name')
                    ->searchable()
                    ->required(),
            ]);
    }
}
