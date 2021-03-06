<?php

namespace App\Models;

use App\Models\Pos;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function poss() {
        return $this->hasMany(Pos::class);
    }
}
