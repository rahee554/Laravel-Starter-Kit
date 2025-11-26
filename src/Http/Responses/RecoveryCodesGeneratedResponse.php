<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Laravel\Fortify\Contracts\RecoveryCodesGeneratedResponse as RecoveryCodesGeneratedResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class RecoveryCodesGeneratedResponse implements RecoveryCodesGeneratedResponseContract
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

        return back()->with('status', __('Recovery codes regenerated.'));
    }
}
