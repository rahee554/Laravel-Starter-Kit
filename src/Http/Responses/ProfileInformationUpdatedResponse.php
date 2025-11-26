<?php

namespace ArtflowStudio\StarterKit\Http\Responses;

use Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse as ProfileInformationUpdatedResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ProfileInformationUpdatedResponse implements ProfileInformationUpdatedResponseContract
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
            return new JsonResponse(['message' => __('Profile information updated.')], 200);
        }

        return back()->with('status', __('Profile information updated.'));
    }
}
