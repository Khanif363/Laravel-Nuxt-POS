<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();

        return response()->json([
            'message'           => "Sukses mendapatkan kategori",
            'data'              => $kategori,
            'status'            => true
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
    public function store(KategoriRequest $request)
    {
        $kategori = Kategori::create([
            'nama'              => $request->nama
        ]);

        return response()->json([
            'message'           => "Sukses create kategori",
            'data'              => $kategori,
            'status'            => true
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
        $kategori = Kategori::find($id);

        return response()->json([
            'message'           => "Sukses mendapatkan detail kategori",
            'data'              => $kategori,
            'status'            => true
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {
        $kategori = Kategori::find($id);

        $kategori->update([
            'nama'              => $request->nama
        ]);

        return response()->json([
            'message'           => "Sukses update kategori",
            'data'              => $kategori,
            'status'            => true
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
        $kategori = Kategori::find($id);

        $kategori->delete();

        return response()->json([
            'message'           => "Sukses delete kategori",
            'data'              => $kategori,
            'status'            => true
        ]);
    }
}
