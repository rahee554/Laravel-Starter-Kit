<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse as FailedPasswordResetLinkRequestResponseContract;

class FailedPasswordResetLinkRequestResponse implements FailedPasswordResetLinkRequestResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $status
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request, string $status = ''): mixed
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [$status],
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $status]);
    }
}
