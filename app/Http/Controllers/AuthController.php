<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['name' => $request->name,'password' => $request->password])) {
            $token = Auth::user()->createToken('LaravelPassword');

            return response()->json(['token' => $token->plainTextToken, 'success' => true], Response::HTTP_OK);
        }

        return response()->json(['success' => false], Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Logout efetuado com sucesso!']);
    }
}
