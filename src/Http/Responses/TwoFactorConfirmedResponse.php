<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Laravel\Fortify\Contracts\TwoFactorConfirmedResponse as TwoFactorConfirmedResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class TwoFactorConfirmedResponse implements TwoFactorConfirmedResponseContract
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
            return new JsonResponse('', 200);
        }

        return back()->with('status', __('Two factor authentication confirmed.'));
    }
}
