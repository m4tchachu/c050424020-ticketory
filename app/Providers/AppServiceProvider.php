<?php

namespace App\Providers;

use Filament\Auth\Http\Responses\LoginResponse as ResponsesLoginResponse;
use Filament\Auth\Http\Responses\LogoutResponse as ResponsesLogoutResponse;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\LogoutResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 
     * The container singleton that should be registered.
     * @var array<class-string, class-string>
     */
    public $singletons = [
        ResponsesLoginResponse::class => LoginResponse::class,
        ResponsesLogoutResponse::class => LogoutResponse::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
