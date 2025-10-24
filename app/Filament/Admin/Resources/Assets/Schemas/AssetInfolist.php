<?php

namespace App\Filament\Admin\Resources\Assets\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AssetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                ->columns(2)
                ->schema([
                    TextEntry::make('name')
                        ->label('Nama Aset')
                        ->extraAttributes(['class' => 'font-bold']),

                    TextEntry::make('code')
                        ->label('Kode Aset'),

                    TextEntry::make('category.name')
                        ->label('Kategori'),

                    TextEntry::make('unit.name')
                        ->label('Unit / Lokasi'),

                    TextEntry::make('vendor')
                        ->label('Vendor')
                        ->default('-'),
                    
                    TextEntry::make('status')
                        ->label('Status'),
                ]),

                Section::make('Pembelian & Garansi')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('purchase_date')
                            ->label('Tanggal Pembelian')
                            ->date(),

                        TextEntry::make('purchase_price')
                            ->label('Harga Beli')
                            ->numeric()
                            ->money('IDR'),

                        TextEntry::make('warranty_expiry')
                            ->label('Masa Garansi')
                            ->date(),
                ]),

                Section::make('Metadata')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d M Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->dateTime('d M Y H:i'),
                    ]),
            ]);
    }
}

