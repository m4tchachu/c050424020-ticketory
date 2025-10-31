<?php

namespace App\Filament\Exports;

use App\Models\Ticket;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Action;
use Illuminate\Support\Number;

class TicketExporter extends Exporter
{
    protected static ?string $model = Ticket::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('title')
                ->label('Title'),
            ExportColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn($state) => match ($state) {
                    'open' => 'Open',
                    'in_progress' => 'In Progress',
                    'pending' => 'Pending',
                    'resolved' => 'Resolved',
                    'rejected' => 'Rejected',
                    default => ucfirst($state),
                }),

            ExportColumn::make('priority')
                ->label('Priority'),

            ExportColumn::make('category.name')
                ->label('Category'),
                
            ExportColumn::make('user.name')
                ->label('Reporter'),

            ExportColumn::make('technician.user.name')
                ->label('Assigned Technician'),

            ExportColumn::make('created_at')
                ->label('Created At'),

            ExportColumn::make('updated_at')
                ->label('Updated At')
                ->enabledByDefault(false),
        ];
    }
    public function getFormats(): array
    {
        return [
            ExportFormat::Csv,
            ExportFormat::Xlsx,
        ];
    }

    public function getFileName(Export $export): string
    {
        return 'tickets-' . now()->format('Ymd-His');
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export selesai: ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . 'baris berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
    
    public static function getCompletedNotificationActions(Export $export): array
    {
        return $export->successful_rows > 0 
        ?[
            Action::make('download')
                ->label('Download File')
                ->url($export->getDownloadUrl(), shouldOpenInNewTab: true),
        ]
        : [];
    }
}
