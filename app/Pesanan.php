<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    public function user(){
        return $this->belongsTo("App\User","user_id","id");
    }

    public function pesanan_detail(){
        return $this->hasMany("App\Pesanan_Detail","pesanan_id","id");
    }

    protected $fillable=["user_id","tanggal","jumlah_harga","status"];
}
