<?php

namespace App\Filament\Admin\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use App\Filament\Exports\TicketExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->label('Title'),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->color([
                        'success' => 'resolved',
                        'warning' => 'pending',
                        'info' => 'in_progress',
                        'danger' => 'rejected',
                        'gray' => 'open',
                    ])
                    ->formatStateUsing(fn($state) => match ($state) {
                        'open' => 'Open',
                        'in_progress' => 'In Progress',
                        'pending' => 'Pending',
                        'resolved' => 'Resolved',
                        'rejected' => 'Rejected',
                        default => ucfirst($state),
                    }),

                TextColumn::make('priority')
                    ->label('Priority')
                    ->sortable(),
                    
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Reporter')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('technician.user.name')
                    ->label('Assigned Technician')
                    ->sortable()
                    ->searchable()
                    ->default('Unassigned'),
                    
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export')
                    ->icon(Heroicon::OutlinedArrowDownOnSquare)
                    ->exporter(TicketExporter::class)
                    ->formats([ExportFormat::Csv, ExportFormat::Xlsx])
                    ->fileName(fn() => 'tickets-' . now()->format('Ymd_His')),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->label('Export Selected')
                        ->exporter(TicketExporter::class),
                ]),
            ]);
    }
}
