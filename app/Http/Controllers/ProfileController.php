<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profile()
    {
        $authUser = auth()->user();
        $biometrics = DB::table('webauthn_credentials')
            ->where('authenticatable_id', $authUser->id)
            ->get();

        return view('profile.index', compact('authUser', 'biometrics'));
    }

    public function biometricDataRender()
    {
        $authUser = auth()->user();
        $biometrics = DB::table('webauthn_credentials')
            ->where('authenticatable_id', $authUser->id)
            ->get();
        return view('components.biometric_data', compact('authUser', 'biometrics'))->render();
    }

    public function biometricDataDestroy($id)
    {
        $authUser = auth()->user();
        $biometrics = DB::table('webauthn_credentials')->where('id', $id)->where('authenticatable_id', $authUser->id)->delete();
        return 'success';
    }
}
