<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan_Detail extends Model
{
    public function barang(){
        return $this->belongsTo("App\Barang","barang_id","id");
    }

    public function pesanan(){
        return $this->belongsTo("App\Pesanan","pesanan_id","id");
    }

    protected $filable=["pesanan_id","jumlah","jumlah_harga"];

    protected $table="pesanan_details";
}
