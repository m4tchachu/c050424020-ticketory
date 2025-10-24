<?php

namespace App\Filament\Admin\Resources\Assets\Schemas;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Vendor;
use Filament\Forms\Components\DatePicker;
use Filament\Form\Component\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Aset')
                    ->required(),
            
                TextInput::make('category_id')
                    ->label('Kategori')
                    ->options(Category::all()->pluck('name','id'))
                    ->required(),

                TextInput::make('unit_id')
                    ->label('Unit / Lokasi')
                    ->options(Unit::all()->pluck('name','id'))
                    ->searchable()
                    ->required(),

                TextInput::make('vendor_id')
                    ->label('Vendor')
                    ->options(Vendor::all()->pluck('name','id'))
                    ->searchable()
                    ->nullable(),

                TextInput::make('status')
                    ->label('Status')
                    ->options([
                        'baik' => 'Baik',
                        'rusak' => 'Rusak',
                    ])
                    ->default('baik')
                    ->required(),
                    
                DatePicker::make('purchase_date')
                    ->label('Tanggal Pembelian'),

                TextInput::make('purchase_price')
                    ->label('Harga Beli')
                    ->numeric()
                    ->nullable(),

                DatePicker::make('warranty_expiry')
                    ->label('Masa Garansi'),
            ]);
    }
}
