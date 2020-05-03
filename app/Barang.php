<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable=[
        "nama_barang",
        "harga",
        "stok",
        "gambar",
        "keterangan",
        "user_id"
    ];

    public function pesanan_detail(){
        return $this->hasMany("App\Pesanan_Detail","barang_id","id");
    }

    public function user(){
        return $this->belongsTo("App\User","user_id");
    }
}
