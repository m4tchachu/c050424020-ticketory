<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard;
use Symfony\Component\HttpFoundation\Response;

class RedirectToProperPanelMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $currentPanel = Filament::getCurrentPanel()?->getId();

            if ($user->hasRole('admin') && $currentPanel !== 'admin') {
                return redirect()->to(Dashboard::getUrl(panel: 'admin'));
            }
            
            if ($user->hasRole('technician') && $currentPanel !== 'technician') {
                return redirect()->to(Dashboard::getUrl(panel: 'technician'));
            }

            if ($user->hasRole('user') && $currentPanel !== 'user') {
                return redirect()->to(Dashboard::getUrl(panel: 'user'));
            }
        }
        return $next($request);
    }
}

