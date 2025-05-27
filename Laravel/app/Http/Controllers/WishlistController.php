<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api')->user();
        $saldo = $user->saldo;

        $wishlists = $user->wishlists()->get()->map(function ($item) use ($saldo) {
            $item->bisa_dibeli = $item->harga <= $saldo;
            // Ubah di sini, hanya path relatif tanpa domain lengkap
            $item->gambar_url = 'layout/' . $item->gambar;
            return $item;
        });

        return response()->json($wishlists);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'required|string',
        ]);

        $user = Auth::guard('api')->user();

        $wishlist = Wishlist::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'gambar' => $request->gambar,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item added to wishlist',
            'data' => $wishlist
        ]);
    }

    public function beli(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $user = Auth::guard('api')->user();

        if ($user->saldo < $request->harga) {
            return response()->json([
                'status' => false,
                'message' => 'Saldo tidak cukup'
            ]);
        }

        $user->saldo -= $request->harga;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Item berhasil dibeli. Saldo dikurangi.'
        ]);
    }

    public function showByStatus()
    {
        $user = Auth::guard('api')->user();
        $saldo = $user->saldo;

        $bisa_dibeli = [];
        $tidak_bisa_dibeli = [];

        $user->wishlists()->get()->each(function ($item) use ($saldo, &$bisa_dibeli, &$tidak_bisa_dibeli) {
            $item->gambar_url = 'layout/' . $item->gambar;
            if ($item->harga <= $saldo) {
                $bisa_dibeli[] = $item;
            } else {
                $tidak_bisa_dibeli[] = $item;
            }
        });

        return response()->json([
            'bisa_dibeli' => $bisa_dibeli,
            'tidak_bisa_dibeli' => $tidak_bisa_dibeli
        ]);
    }

    public function uploadGambar(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required|string',
            'harga' => 'required|integer',
        ]);

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('layout'), $filename);

        $user = Auth::guard('api')->user();

        $wishlist = Wishlist::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'gambar' => 'layout/' . $filename,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Wishlist berhasil ditambahkan',
            'data' => $wishlist
        ]);
    }
    public function beliwishlist(Request $request)
{
    $request->validate([
        'wishlist_id' => 'required|integer',
    ]);

    $user = Auth::guard('api')->user();
    $wishlist = Wishlist::where('id', $request->wishlist_id)
                        ->where('user_id', $user->id)
                        ->first();

    if (!$wishlist) {
        return response()->json([
            'status' => false,
            'message' => 'Item wishlist tidak ditemukan'
        ], 404);
    }

    if ($user->saldo < $wishlist->harga) {
        return response()->json([
            'status' => false,
            'message' => 'Saldo tidak cukup'
        ]);
    }

    $user->saldo -= $wishlist->harga;
    $user->save();
    $wishlist->delete();

    return response()->json([
        'status' => true,
        'message' => 'Item berhasil dibeli dan dihapus dari wishlist',
    ]);
}

}
