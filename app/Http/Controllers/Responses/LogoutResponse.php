<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\LogoutResponse as ResponsesLogoutResponse;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;

class LogoutResponse extends ResponsesLogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect('/login');
    }
}