<?php

namespace App\Filament\Admin\Resources\Assets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Aset')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->label('Kode')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('unit.name')
                    ->label('Unit / Lokasi')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('status')
                    ->label('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('purchase_date')
                    ->label('Tanggal Pembelian')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('purchase_price')
                    ->label('Harga Beli')
                    ->money('IDR', true)
                    ->sortable(),

                TextColumn::make('warranty_expiry')
                    ->label('Masa Garansi')
                    ->date('d M Y')
                    ->sortable()
                    ->badge()
                    ->color(
                        fn($state) =>
                        $state < now() ? 'danger' : 'success'
                    ),

                TextColumn::make('created_at')
                    ->label ('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->label ('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
