<?php

namespace App\Http\Controllers\WebAuthn;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Laragear\WebAuthn\Http\Requests\AttestationRequest;
use Laragear\WebAuthn\Http\Requests\AttestedRequest;
use function response;

class WebAuthnRegisterController
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function options(AttestationRequest $request): Responsable
    {
        return $request
            ->fastRegistration()
            //            ->userless()
            //            ->allowDuplicates()
            ->toCreate();
    }

    public function register(AttestedRequest $request): Response
    {
        $request->save();

        return response()->noContent();
    }
}
