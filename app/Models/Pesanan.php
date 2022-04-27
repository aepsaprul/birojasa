<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function samsatAsal() {
        return $this->belongsTo(Kota::class, 'samsat_asal', 'id');
    }

    public function samsatTujuan() {
        return $this->belongsTo(Kota::class, 'samsat_tujuan', 'id');
    }
}
