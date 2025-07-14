<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class AuthController extends Controller
// {
//     /**
//      * Method untuk login dan membuat token.
//      */
//     public function login(Request $request)
//     {
//         $credentials = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         if (!Auth::attempt($credentials)) {
//             return response()->json(['message' => 'Login gagal'], 401);
//         }

//         /** @var \App\Models\User $user */
//         $user = Auth::user();
//         $token = $user->createToken('api-token')->plainTextToken;

//         return response()->json([
//             'user' => $user,
//             'token' => $token,
//         ]);
//     }

//     /**
//      * BARU: Method untuk logout dan menghapus token.
//      */
//     public function logout(Request $request)
//     {
//         // Menghapus token yang sedang digunakan untuk otentikasi
//         $request->user()->currentAccessToken()->delete();

//         return response()->json(['message' => 'Logout berhasil']);
//     }
//}

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    /**
     * Method untuk login dan membuat token.
     */
    public function login(Request $request)
    {
        response()->header('X-Content-Type-Options', 'nosniff');
        response()->header('X-Frame-Options', 'DENY');
        response()->header('X-XSS-Protection', '1; mode=block');
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Kredensial tidak valid.'], 401);
            }

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $token = $user->createToken('auth-token-'.$user->name)->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ], 200); // 200 OK: Eksplisit lebih baik

        } catch (Exception $e) {
            // Catat error untuk debugging
            Log::error('Login Error: ' . $e->getMessage());

            // Kembalikan respons error yang rapi
            return response()->json(['message' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    /**
     * Method untuk logout dan menghapus token.
     */
    public function logout(Request $request)
    {
        try {
            // Menghapus token yang sedang digunakan untuk otentikasi
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Logout berhasil.'], 200); // 200 OK

        } catch (Exception $e) {
             // Catat error untuk debugging
            Log::error('Logout Error: ' . $e->getMessage());

             // Kembalikan respons error yang rapi
            return response()->json(['message' => 'Gagal melakukan logout.'], 500);
        }
    }
}