<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('api')->attempt($credentials)) {
            // Dapatkan pengguna yang telah terotentikasi
            $user = Auth::guard('api')->user();

            // Jika menggunakan token, buat dan kembalikan token di sini
            // Contoh: $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                // 'token' => $token, // Kembalikan token jika menggunakan sistem token
            ], 200);
        }



        return response()->json(['message' => 'The provided credentials do not match our records.'], 401);
    }
}
