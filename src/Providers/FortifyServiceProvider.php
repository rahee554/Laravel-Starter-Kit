<?php

namespace ArtflowStudio\StarterKit\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
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
        // Register view responses using StarterKit views
        Fortify::loginView(fn () => view('starterkit::auth.login'));
        Fortify::registerView(fn () => view('starterkit::auth.register'));
        Fortify::requestPasswordResetLinkView(fn () => view('starterkit::auth.forgot-password'));
        Fortify::resetPasswordView(fn ($request) => view('starterkit::auth.reset-password', ['request' => $request]));
        Fortify::verifyEmailView(fn () => view('starterkit::auth.verify-email'));
        Fortify::confirmPasswordView(fn () => view('starterkit::auth.confirm-password'));
        Fortify::twoFactorChallengeView(fn () => view('starterkit::auth.two-factor-challenge'));

        // Rate limiting configuration
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
