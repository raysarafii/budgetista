<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function getProfile(Request $request)
    {
        // Gunakan guard 'api' untuk ambil user yang terautentikasi via Sanctum
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak terotentikasi',
                'data' => null,
            ], 401);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak terotentikasi',
                'data' => null,
            ], 401);
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email',
            'pekerjaan' => 'nullable|string'
        ]);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->pekerjaan = $request->pekerjaan;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }
    public function updateSaldo(Request $request)
{
    $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'User tidak terotentikasi',
            'data' => null,
        ], 401);
    }

    $request->validate([
        'saldo' => 'required|numeric|min:0',
    ]);

    $user->saldo = $request->saldo;
    $user->save();

    return response()->json([
        'status' => true,
        'message' => 'Saldo berhasil diperbarui',
        'data' => $user
    ]);
}
}

