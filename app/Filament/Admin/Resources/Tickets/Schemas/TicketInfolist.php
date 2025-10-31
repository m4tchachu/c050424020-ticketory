<?php

namespace App\Filament\Admin\Resources\Tickets\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ticket Info')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Title')
                            ->placeholder('-'),
                        
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'Open' => 'primary',
                                'pending' => 'warning',
                                'Closed' => 'success',
                                'Overdue' => 'danger',
                                default => 'gray',
                            })
                            ->placeholder('Unknown'),

                        TextEntry::make('priority')
                            ->label('Priority')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'Low' => 'success',
                                'Medium' => 'warning',
                                'High' => 'danger',
                                default => 'gray',
                            })
                            ->placeholder('Not Set'),
                        
                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('-'),
                        ]),
                        
                Section::make('Unit Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('category.name')
                            ->label('Category')
                            ->placeholder('Uncategorized'),

                        TextEntry::make('unit.name')
                            ->label('Unit')
                            ->placeholder('No Unit'),
                        TextEntry::make('unit location')
                            ->label('Unit Location')
                            ->placeholder('No Location'),
                    ]),

                Section::make('Assignments')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Reported By')
                            ->placeholder('Anonymous'),

                        TextEntry::make('technician.user.name')
                            ->label('Assigned Technician')
                            ->placeholder('Unassigned'),
                    ]),

                Section::make('Timeline')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime('d M Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('d M Y H:i'),
                    ]),

                Section::make('Attachments')
                    ->columns(3)
                    ->schema([
                        ImageEntry::make('attachments')
                            ->label('First Attachment')
                            ->square()
                            ->imageSize(150)
                            ->visibility('public')
                            ->getStateUsing(
                                fn ($record) => 
                                $record->attachments()->oldest()->first()?->file_path
                                ?asset('storage/' . $record->attachments()->oldest()->first()?->file_path):null)
                                ->defaultImageUrl(url('storage/default.png')),
                    ])
            ]);
    }
}