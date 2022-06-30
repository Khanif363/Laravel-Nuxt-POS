<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        $total_produk = $produk->count();
        $produk_filter = Produk::where('status', 1)->get();

        return response()->json([
            'message'       => 'Suskses mendapatkan produk',
            'data'          => $produk,
            'filter'        => $produk_filter,
            'total_produk'  => $total_produk,
            'status'        => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {

        $produk = Produk::create([
            'nama'          => $request->nama,
            'kategori_id'   => $request->kategori_id,
            'harga'         => $request->harga,
            'kuantitas'     => $request->kuantitas
        ]);

        if($produk->kuantitas > 0) {
            $produk->status = 1;
            $produk->save();
        } else {
            $produk->status = 0;
            $produk->save();
        }

        return response()->json([
            'message'       => "Sukses menambahkan produk",
            'data'          => $produk,
            'status'        => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::with('kategori')->find($id);

        return response()->json([
            'message'       => "Sukses show produk",
            'data'          => $produk,
            'status'        => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukRequest $request, $id)
    {
        $produk = Produk::find($id);

        $produk->update([
            'nama'          => $request->nama,
            'kategori_id'   => $request->kategori_id,
            'harga'         => $request->harga,
            'kuantitas'     => $request->kuantitas
        ]);

        if($produk->kuantitas > 0) {
            $produk->status = 1;
            $produk->save();
        } else {
            $produk->status = 0;
            $produk->save();
        }


        return response()->json([
            'message'       => "Sukses update produk",
            'data'          => $produk,
            'status'        => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);

        $produk->delete();

        return response()->json([
            'message'       => "Sukses delete produk",
            'data'          => $produk,
            'status'        => true
        ]);
    }
}
