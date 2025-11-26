<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\EmailVerificationNotificationSentResponse as EmailVerificationNotificationSentResponseContract;

class EmailVerificationNotificationSentResponse implements EmailVerificationNotificationSentResponseContract
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
            return new JsonResponse(['message' => __('Verification link sent.')], 202);
        }

        return back()->with('status', __('verification-link-sent'));
    }
}
