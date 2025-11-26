<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\LockoutResponse as LockoutResponseContract;

class LockoutResponse implements LockoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $throttleSeconds
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request, int $throttleSeconds = 0): RedirectResponse
    {
        return back()->withErrors([
            'email' => __('Too many login attempts. Please try again in :seconds seconds.', [
                'seconds' => $throttleSeconds,
            ]),
        ]);
    }
}
