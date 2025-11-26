<?php

namespace ArtflowStudio\StarterKit\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * AuthService - Custom Authentication Logic
 * 
 * Handles role-based redirections, post-login hooks, and custom auth workflows
 * 
 * This service can be published to app/Services/ for customization:
 *   php artisan starterkit:install --publish-auth-service
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
     * Supports Spatie Laravel Permission package for role-based redirects.
     * If roles are not used, all users go to /dashboard
     * 
     * @param Model $user
     * @param Request|null $request
     * @return string URL path or route name
     */
    public static function redirectAfterLogin(Model $user, ?Request $request = null): string
    {
        // Check if Spatie Laravel Permission is available and user has roles
        if (method_exists($user, 'hasRole')) {
            // Role-based redirection (customize these as needed)
            if ($user->hasRole('admin')) {
                return '/admin/dashboard';
            }
            
            if ($user->hasRole('moderator')) {
                return '/moderator/dashboard';
            }
            
            if ($user->hasRole('manager')) {
                return '/manager/dashboard';
            }
            
            // Add more role checks as needed
        }
        
        // Default redirect for all users without specific roles
        return '/dashboard';
    }

    /**
     * Redirect user after successful registration
     * 
     * @param Model $user
     * @param Request|null $request
     * @return string URL path or route name
     */
    public static function redirectAfterRegister(Model $user, ?Request $request = null): string
    {
        // Check if email verification is required
        if (!$user->email_verified_at && static::shouldRequireEmailVerification($user)) {
            return '/email/verify';
        }
        
        // Default: redirect to dashboard
        // You can customize this to redirect to onboarding, profile setup, etc.
        return '/dashboard';
    }

    /**
     * Redirect after password reset
     * 
     * @param Model $user
     * @return string URL path or route name
     */
    public static function redirectAfterPasswordReset(Model $user): string
    {
        return '/login';
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
