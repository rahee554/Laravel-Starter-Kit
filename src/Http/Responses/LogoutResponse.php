<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request): RedirectResponse|JsonResponse
    {
        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : redirect('/');
    }
}
