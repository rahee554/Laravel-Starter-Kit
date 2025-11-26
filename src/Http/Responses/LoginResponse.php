<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use ArtflowStudio\StarterKit\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request): RedirectResponse|JsonResponse
    {
        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        $user = auth()->user();
        
        // Use AuthService to determine redirect location
        $redirectTo = AuthService::redirectAfterLogin($user, $request);
        
        // Call post-login hooks
        AuthService::afterLogin($user, $request);
        
        // Convert route name to URL if it's a named route, otherwise use as-is
        $url = $this->resolveRedirectUrl($redirectTo);
        
        return redirect()->intended($url);
    }
    
    /**
     * Resolve redirect URL from route name or URL
     * 
     * @param string $redirectTo Route name or URL
     * @return string
     */
    protected function resolveRedirectUrl(string $redirectTo): string
    {
        // If it starts with http:// or https:// or /, treat as URL
        if (str_starts_with($redirectTo, 'http://') || 
            str_starts_with($redirectTo, 'https://') || 
            str_starts_with($redirectTo, '/')) {
            return $redirectTo;
        }
        
        // Try to resolve as route name
        try {
            return route($redirectTo);
        } catch (\Exception $e) {
            // If route doesn't exist, fall back to /home or treat as path
            return str_starts_with($redirectTo, '/') ? $redirectTo : '/' . $redirectTo;
        }
    }
}
