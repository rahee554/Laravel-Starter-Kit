<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse as SuccessfulPasswordResetLinkRequestResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class SuccessfulPasswordResetLinkRequestResponse implements SuccessfulPasswordResetLinkRequestResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $status
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request, string $status = ''): RedirectResponse|JsonResponse
    {
        if ($request->wantsJson()) {
            return new JsonResponse(['message' => $status], 200);
        }

        return back()->with('status', $status);
    }
}
