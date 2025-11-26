<?php

namespace ArtflowStudio\StarterKit\Providers;

use ArtflowStudio\StarterKit\Helpers\StarterKitHelper;
use ArtflowStudio\StarterKit\Http\Responses\LoginResponse as StarterKitLoginResponse;
use ArtflowStudio\StarterKit\Http\Responses\RegisterResponse as StarterKitRegisterResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
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
        // Bind StarterKit's custom response classes to Fortify's response contracts
        // This allows us to use AuthService for redirects instead of Fortify's defaults
        
        // Authentication Responses
        $this->app->singleton(LoginResponse::class, StarterKitLoginResponse::class);
        $this->app->singleton(RegisterResponse::class, StarterKitRegisterResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\LogoutResponse::class, \ArtflowStudio\StarterKit\Http\Responses\LogoutResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\TwoFactorLoginResponse::class, \ArtflowStudio\StarterKit\Http\Responses\TwoFactorLoginResponse::class);
        
        // Password Reset Responses
        $this->app->singleton(\Laravel\Fortify\Contracts\PasswordResetResponse::class, \ArtflowStudio\StarterKit\Http\Responses\PasswordResetResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\PasswordUpdateResponse::class, \ArtflowStudio\StarterKit\Http\Responses\PasswordUpdateResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse::class, \ArtflowStudio\StarterKit\Http\Responses\SuccessfulPasswordResetLinkRequestResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse::class, \ArtflowStudio\StarterKit\Http\Responses\FailedPasswordResetLinkRequestResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\FailedPasswordResetResponse::class, \ArtflowStudio\StarterKit\Http\Responses\FailedPasswordResetResponse::class);
        
        // Password Confirmation Responses
        $this->app->singleton(\Laravel\Fortify\Contracts\PasswordConfirmedResponse::class, \ArtflowStudio\StarterKit\Http\Responses\PasswordConfirmedResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\FailedPasswordConfirmationResponse::class, \ArtflowStudio\StarterKit\Http\Responses\FailedPasswordConfirmationResponse::class);
        
        // Profile Responses
        $this->app->singleton(\Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse::class, \ArtflowStudio\StarterKit\Http\Responses\ProfileInformationUpdatedResponse::class);
        
        // Two-Factor Authentication Responses
        $this->app->singleton(\Laravel\Fortify\Contracts\TwoFactorEnabledResponse::class, \ArtflowStudio\StarterKit\Http\Responses\TwoFactorEnabledResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\TwoFactorDisabledResponse::class, \ArtflowStudio\StarterKit\Http\Responses\TwoFactorDisabledResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\TwoFactorConfirmedResponse::class, \ArtflowStudio\StarterKit\Http\Responses\TwoFactorConfirmedResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\RecoveryCodesGeneratedResponse::class, \ArtflowStudio\StarterKit\Http\Responses\RecoveryCodesGeneratedResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\FailedTwoFactorLoginResponse::class, \ArtflowStudio\StarterKit\Http\Responses\FailedTwoFactorLoginResponse::class);
        
        // Email Verification Responses
        $this->app->singleton(\Laravel\Fortify\Contracts\VerifyEmailResponse::class, \ArtflowStudio\StarterKit\Http\Responses\VerifyEmailResponse::class);
        $this->app->singleton(\Laravel\Fortify\Contracts\EmailVerificationNotificationSentResponse::class, \ArtflowStudio\StarterKit\Http\Responses\EmailVerificationNotificationSentResponse::class);
        
        // Rate Limiting Response
        $this->app->singleton(\Laravel\Fortify\Contracts\LockoutResponse::class, \ArtflowStudio\StarterKit\Http\Responses\LockoutResponse::class);
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
