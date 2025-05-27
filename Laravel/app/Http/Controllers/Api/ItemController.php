<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
{
    $kategori = $request->query('kategori');

    if ($kategori) {
        $items = Item::where('kategori', $kategori)->get();
    } else {
        $items = Item::all();
    }

    return response()->json($items);
}

}
