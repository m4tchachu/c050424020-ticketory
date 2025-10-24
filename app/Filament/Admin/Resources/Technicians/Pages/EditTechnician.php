<?php

namespace App\Filament\Admin\Resources\Technicians\Pages;

use App\Filament\Admin\Resources\Technicians\TechnicianResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTechnician extends EditRecord
{
    protected static string $resource = TechnicianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
