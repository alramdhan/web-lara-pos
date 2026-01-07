<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;

class KasirAuthController extends BaseController
{
    public function __constructor()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }

    public function login(LoginRequest $request)
    {
        $validateData = $request->validated();
        $fieldType = filter_var($validateData['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(!Auth::attempt([$fieldType => $validateData['login'], 'password' => $validateData['password']]))
        {
            return $this->sendError('Kredensial tidak valid', $code = 401);
        }

        $kasir = Auth::user();
        // Hapus token lama jika diperlukan, lalu buat token baru
        $kasir->tokens()->delete();
        $token = $kasir->createToken('kasir-token', ['server:update'])->plainTextToken;

        return $this->sendResponse([
            'user' => $kasir,
            'access_token' => $token,
        ], 'Login Berhasil');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        // Hapus token yang sedang digunakan
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
