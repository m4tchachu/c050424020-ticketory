<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Actions\Action;

class UserForm
{
    public static function configure(Schema $schema, bool $isCreate = true): Schema
    {
        $roles = ['admin', 'technician', 'user'];

        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),

                TextInput::make('password')
                    ->label('Password')
                    ->type('password')
                    ->helperText('Kosongkan jika tidak ingin mengganti password')
                    ->dehydrateStateUsing(function ($state, $record) {
                        return $state ? Hash::make($state) : $record->password;
                    })
                    ->afterStateHydrated(fn($component, $state) => $component->state(null))
                    ->suffixAction(
                        Action::make('toggle-password-visibility')
                            ->icon('heroicon-o-eye')
                            ->action(function ($component) {
                                $component->type($component->getType() === 'password' ? 'text' : 'password');
                            })
                    ),
                
                Select::make('role')
                    ->label('Role')
                    ->options(array_combine($roles, $roles))
                    ->required()
                    ->afterStateHydrated(function ($component, $state, $record) {
                        if ($record) {
                            $component->state($record->roles->pluck('name')->first());
                        }
                    })
                    ->dehydrateStateUsing(function ($state, $record) {
                        if ($state) {
                            $record->syncRoles([$state]);
                        }
                        return $state;
                    }),
            ]);
    }
}
