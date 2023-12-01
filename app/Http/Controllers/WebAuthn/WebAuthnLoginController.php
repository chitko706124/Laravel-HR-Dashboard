<?php

namespace App\Http\Controllers\WebAuthn;

use function response;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;
use Laragear\WebAuthn\Http\Requests\AssertedRequest;
use Laragear\WebAuthn\Http\Requests\AssertionRequest;

class WebAuthnLoginController
{
    /**
     * Returns the challenge to assertion.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AssertionRequest  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function options(AssertionRequest $request): Responsable
    {
        $type = $request['phone'] == null ? 'email' : 'phone';

        return $request->toVerify($request->validate([$type => 'required']));
    }

    /**
     * Log the user in.
     *
     * @param  \Laragear\WebAuthn\Http\Requests\AssertedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AssertedRequest $request): Response
    {
        // return response()->noContent(204);

        return response()->noContent($request->login() ? 204 : 422);
    }
}
