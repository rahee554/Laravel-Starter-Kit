<?php

namespace ArtflowStudio\StarterKit\Providers;

use ArtflowStudio\StarterKit\Helpers\StarterKitHelper;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;

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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // Get the configured auth layout
        $authLayout = StarterKitHelper::getDefaultAuthLayoutView();

        // Register view responses using StarterKit views with dynamic layout
        Fortify::loginView(fn () => view('starterkit::auth.login', ['layout' => $authLayout]));
        Fortify::registerView(fn () => view('starterkit::auth.register', ['layout' => $authLayout]));
        Fortify::requestPasswordResetLinkView(fn () => view('starterkit::auth.forgot-password', ['layout' => $authLayout]));
        Fortify::resetPasswordView(fn ($request) => view('starterkit::auth.reset-password', ['request' => $request, 'layout' => $authLayout]));
        Fortify::verifyEmailView(fn () => view('starterkit::auth.verify-email', ['layout' => $authLayout]));
        Fortify::confirmPasswordView(fn () => view('starterkit::auth.confirm-password', ['layout' => $authLayout]));
        Fortify::twoFactorChallengeView(fn () => view('starterkit::auth.two-factor-challenge', ['layout' => $authLayout]));

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
