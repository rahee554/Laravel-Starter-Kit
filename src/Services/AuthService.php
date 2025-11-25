<?php

namespace ArtflowStudio\StarterKit\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * AuthService - Custom Authentication Logic
 * 
 * Handles role-based redirections, post-login hooks, and custom auth workflows
 * 
 * Usage:
 *   AuthService::redirectAfterLogin($user)
 *   AuthService::redirectAfterRegister($user)
 *   AuthService::beforeLogin($request)
 */
class AuthService
{
    /**
     * Redirect user based on role after successful login
     * 
     * @param Model $user
     * @param Request|null $request
     * @return string Route name or URL
     */
    public static function redirectAfterLogin(Model $user, ?Request $request = null): string
    {
        // TODO: Add role-based redirection logic here
        // Example:
        // if ($user->hasRole('admin')) {
        //     return 'admin.dashboard';
        // } elseif ($user->hasRole('moderator')) {
        //     return 'moderator.dashboard';
        // }
        
        // Default redirect
        return 'dashboard';
    }

    /**
     * Redirect user after successful registration
     * 
     * @param Model $user
     * @param Request|null $request
     * @return string Route name or URL
     */
    public static function redirectAfterRegister(Model $user, ?Request $request = null): string
    {
        // TODO: Add custom post-registration redirect logic
        // Example: redirect to onboarding, setup wizard, etc.
        
        // Default: go to dashboard or verification page
        return $user->email_verified_at ? 'dashboard' : 'verification.notice';
    }

    /**
     * Redirect after password reset
     * 
     * @param Model $user
     * @return string Route name or URL
     */
    public static function redirectAfterPasswordReset(Model $user): string
    {
        // TODO: Add custom logic after password reset
        return 'login';
    }

    /**
     * Hook before login attempt
     * Runs before credentials are validated
     * 
     * @param Request $request
     * @return bool Return false to prevent login
     */
    public static function beforeLogin(Request $request): bool
    {
        // TODO: Add pre-login validation
        // Example: Check if user is banned, has restrictions, etc.
        // $email = $request->input('email');
        // if (/* some condition */) {
        //     return false; // Prevent login
        // }
        
        return true;
    }

    /**
     * Hook after successful login
     * Runs after user is authenticated
     * 
     * @param Model $user
     * @param Request $request
     * @return void
     */
    public static function afterLogin(Model $user, Request $request): void
    {
        // TODO: Add post-login logic
        // Example: Update last login, log activity, send notifications, etc.
        // $user->update(['last_login_at' => now()]);
        // Log activity, send email, etc.
    }

    /**
     * Hook after successful registration
     * Runs after user account is created
     * 
     * @param Model $user
     * @param Request $request
     * @return void
     */
    public static function afterRegister(Model $user, Request $request): void
    {
        // TODO: Add post-registration logic
        // Example: Send welcome email, create initial data, set defaults, etc.
        // Mail::send(new WelcomeEmail($user));
        // Create default settings, preferences, etc.
    }

    /**
     * Hook before logout
     * 
     * @param Model $user
     * @return bool Return false to prevent logout
     */
    public static function beforeLogout(Model $user): bool
    {
        // TODO: Add pre-logout validation
        // Example: Prevent logout if critical action in progress, etc.
        return true;
    }

    /**
     * Hook after logout
     * 
     * @param Model $user
     * @return void
     */
    public static function afterLogout(Model $user): void
    {
        // TODO: Add post-logout logic
        // Example: Log activity, clear cache, etc.
    }

    /**
     * Check if user should require two-factor
     * 
     * @param Model $user
     * @return bool
     */
    public static function shouldRequireTwoFactor(Model $user): bool
    {
        // TODO: Add custom 2FA requirement logic
        // Example: Require 2FA for admin users
        // return $user->hasRole('admin');
        
        return false;
    }

    /**
     * Check if user should require email verification
     * 
     * @param Model $user
     * @return bool
     */
    public static function shouldRequireEmailVerification(Model $user): bool
    {
        // TODO: Add custom email verification requirement
        // Example: Only require for certain roles
        
        return true;
    }

    /**
     * Get custom validation rules for registration
     * 
     * @return array
     */
    public static function getCustomRegistrationRules(): array
    {
        // TODO: Add custom validation rules
        // Example: username uniqueness, domain restrictions, etc.
        return [
            // 'username' => 'required|unique:users|alpha_dash',
        ];
    }

    /**
     * Sanitize user input after registration
     * 
     * @param array $data
     * @return array
     */
    public static function sanitizeRegistrationData(array $data): array
    {
        // TODO: Add data sanitization logic
        // Example: trim, lowercase email, format phone, etc.
        
        return $data;
    }
}
