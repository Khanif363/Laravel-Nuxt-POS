<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukRequest;

class TestController extends Controller
{
    public function store(ProdukRequest $request)
    {

        $produk = Produk::create([
            'nama'          => $request->nama,
            'kategori_id'   => $request->kategori_id,
            'harga'         => $request->harga,
            'kuantitas'     => $request->kuantitas
        ]);

        return response()->json([
            'message'       => "Sukses menambahkan produk",
            'data'          => $produk,
            'status'        => true
        ]);
    }
}
