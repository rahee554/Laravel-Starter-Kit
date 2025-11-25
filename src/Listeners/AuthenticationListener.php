<?php

namespace ArtflowStudio\StarterKit\Listeners;

use ArtflowStudio\StarterKit\Services\AuthService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Logout;

/**
 * AuthenticationListener
 * 
 * Listens to Laravel authentication events and triggers custom logic
 * 
 * Events handled:
 * - Illuminate\Auth\Events\Login
 * - Illuminate\Auth\Events\Registered
 * - Illuminate\Auth\Events\Logout
 */
class AuthenticationListener
{
    /**
     * Handle user login event
     * Triggered automatically when user logs in
     * 
     * @param Login $event
     * @return void
     * 
     * Usage: Add to app/Providers/EventServiceProvider.php
     *   protected $listen = [
     *       Login::class => [AuthenticationListener::class],
     *   ];
     */
    public function handle(Login $event): void
    {
        // TODO: Add custom login event logic
        $user = $event->user;
        
        // Example: Update last login timestamp
        // $user->update(['last_login_at' => now()]);
        
        // Call service method
        AuthService::afterLogin($user, request());
    }

    /**
     * Handle user registration event
     * Triggered automatically when new user registers
     * 
     * @param Registered $event
     * @return void
     * 
     * Usage: Add to app/Providers/EventServiceProvider.php
     *   protected $listen = [
     *       Registered::class => [AuthenticationListener::class],
     *   ];
     */
    public function handleRegistered(Registered $event): void
    {
        // TODO: Add custom registration event logic
        $user = $event->user;
        
        // Example: Send welcome email, create profile, etc.
        // Mail::send(new WelcomeEmail($user));
        
        // Call service method
        AuthService::afterRegister($user, request());
    }

    /**
     * Handle user logout event
     * Triggered automatically when user logs out
     * 
     * @param Logout $event
     * @return void
     * 
     * Usage: Add to app/Providers/EventServiceProvider.php
     *   protected $listen = [
     *       Logout::class => [AuthenticationListener::class],
     *   ];
     */
    public function handleLogout(Logout $event): void
    {
        // TODO: Add custom logout event logic
        $user = $event->user;
        
        // Example: Log activity, clear sessions, etc.
        // activity('auth')
        //     ->performedOn($user)
        //     ->log('User logged out');
        
        // Call service method
        AuthService::afterLogout($user);
    }
}
