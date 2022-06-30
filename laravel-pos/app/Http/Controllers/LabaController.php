<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use Illuminate\Http\Request;

class LabaController extends Controller
{
    public function laba() {
        $pos = Pos::all();

        $laba = $pos->sum('harga');

        return response()->json([
            'data'          => $laba
        ]);
    }
}
