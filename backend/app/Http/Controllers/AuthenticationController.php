<?php

namespace App\Http\Controllers;

use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use ResponseAPI;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return $this->success(
                'User has been authenticated correctly',
                auth()->user()->createToken(auth()->user()->email)->plainTextToken
            );
        } else {
            return $this->error('Unable to authenticate');
        }
    }

    public function logout()
    {
        return $this->success(
            'The session has been successfully closed',
            auth()->user()->currentAccessToken()->delete()
        );
    }
}
