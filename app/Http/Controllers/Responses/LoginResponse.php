<?php 

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\LoginResponse as ResponsesLoginResponse;
use Filament\Pages\Dashboard;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends ResponsesLoginResponse
{
    public function toResponse($request): RedirectResponse
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            return redirect()->to(Dashboard::getUrl(panel: 'admin'));
        }
        
        if ($user->hasRole('Technician')) {
            return redirect()->to(Dashboard::getUrl(panel: 'technician'));
        }

        return redirect()->to(Dashboard::getUrl(panel: 'user'));
    }
}