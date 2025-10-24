<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }
        return $data;
    }

    protected function handleRecordUpdate($record, array $data): \Illuminate\Database\Eloquent\Model
    {
        $record = parent::handleRecordUpdate($record, $data);
        if (isset($data['role'])) {
            $record->syncRoles([$data['role']]);
        }

        return $record;
    }
}
