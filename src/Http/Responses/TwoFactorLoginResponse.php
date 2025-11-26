<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use ArtflowStudio\StarterKit\Services\AuthService;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
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
            return new JsonResponse('', 204);
        }

        $user = auth()->user();
        
        // Use AuthService to determine redirect location
        $redirectTo = AuthService::redirectAfterLogin($user, $request);
        
        // Call post-login hooks
        AuthService::afterLogin($user, $request);
        
        // Convert route name to URL if needed
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
        if (str_starts_with($redirectTo, 'http://') || 
            str_starts_with($redirectTo, 'https://') || 
            str_starts_with($redirectTo, '/')) {
            return $redirectTo;
        }
        
        try {
            return route($redirectTo);
        } catch (\Exception $e) {
            return str_starts_with($redirectTo, '/') ? $redirectTo : '/' . $redirectTo;
        }
    }
}
