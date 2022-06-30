<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\PosRequest;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pos = Pos::with('produk')->get();
        $total_pos = $pos->count();

        return response()->json([
            'message'           => "Sukses mendapatkan data pos",
            'data'              => $pos,
            'total_pos'         => $total_pos,
            'status'            => true
        ]);
    }

    public function store(Request $request)
    {

        if($request->isMethod('post')) {
            $pos = $request->input();
            foreach($pos as $key => $value) {
                $item = Pos::create([
                    'produk_id'         => $value['id'],
                    'kuantitas'         => $value['kuantitas'],
                    'harga'             => $value['harga']
                ]);
                $item->produk->kuantitas = $item->produk->kuantitas - $value['kuantitas'];
                if($item->produk->kuantitas <= 0) {
                    $item->produk->status = 0;
                }
                $item->produk->save();
            }
        }

        return response()->json([
            'message'           => "Sukses membuat data pos",
            'data'              => $pos,
            'status'            => true
        ]);
    }
}
