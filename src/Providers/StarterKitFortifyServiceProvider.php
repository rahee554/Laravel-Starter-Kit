<?php

namespace ArtflowStudio\StarterKit\Providers;

use ArtflowStudio\StarterKit\Actions\Fortify\CreateNewUser;
use ArtflowStudio\StarterKit\Actions\Fortify\ResetUserPassword;
use ArtflowStudio\StarterKit\Actions\Fortify\UpdateUserPassword;
use ArtflowStudio\StarterKit\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class StarterKitFortifyServiceProvider extends ServiceProvider
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
        // Register Fortify action classes
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // Register view responses - use starterkit namespace
        Fortify::loginView(fn () => view('starterkit::layouts.auth.login'));
        Fortify::registerView(fn () => view('starterkit::layouts.auth.register'));
        Fortify::requestPasswordResetLinkView(fn () => view('starterkit::layouts.auth.reset-password'));
        Fortify::resetPasswordView(fn ($request) => view('starterkit::layouts.auth.reset-password', ['request' => $request]));
        Fortify::verifyEmailView(fn () => view('starterkit::layouts.auth.verify-email'));
        Fortify::confirmPasswordView(fn () => view('starterkit::layouts.auth.confirm-password'));
        Fortify::twoFactorChallengeView(fn () => view('starterkit::layouts.auth.two-factor-challenge'));

        // Rate limiting for login attempts
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        // Rate limiting for two-factor attempts
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
