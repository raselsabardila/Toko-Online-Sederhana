@extends('templates_backend.home')

@section("sub-title","Detail Pesanan");

@section('content')
@if (session("status"))
    <div class="alert alert-danger" role="alert">
        {{session("status")}}
    </div>
@endif
<div class="container">
    <div class="alert alert-success" role="alert">
        <h5>Success Check Out</h5>
        @foreach ($pesanan_detail as $item)
            <p>Pesanan Dengan id Pesanan {{$item->barang_id}} Telah Di Check Out Selanjutnya Untuk Pembayaran Harap Transfer Ke Rekening 123321-421314-23 Dengan Nominal Yang Harus Di Bayar Rp.{{number_format($item->jumlah_harga)}}</p>
        @endforeach
    </div>
    <div class="row justify-content-center">
        @if (!empty($pesanan))
        @foreach ($pesanan_detail as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" height="200px" src="{{asset("upload_file")}}/{{$item->barang->gambar}}" alt="">
                            <div class="card-body">
                                <h5 class="card-title" class="item_nama">{{$item->barang->nama_barang}}</h5>
                                <h6 class="car-text">Tanggal Pesan : {{$item->pesanan->tanggal}}</h6>
                                <h6>Code : {{$pesanan->kode}}</h6>
                                <h6 class="card-text float-right">Jumlah : {{($item->jumlah)}}</h6>
                                <h6 class="card-text float-left">Rp.{{number_format($item->jumlah_harga)}}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            <div class="row justify-content-center">
                <span class="badge badge-primary" style="height:35px;width:300px;border-radius:5px">Total Yang Harus Dibayar    : Rp.{{number_format($pesanan->jumlah_harga)}}</span>
            </div>
        @endif
</div>
@endsection