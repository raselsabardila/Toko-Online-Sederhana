@extends('templates_backend.home')

@section("sub-title","Check Out");

@section('content')
@if (session("status"))
    <div class="alert alert-danger" role="alert">
        {{session("status")}}
    </div>
@endif
<div class="container">
    <div class="row">
        @if (!empty($pesanan))
        @foreach ($pesanan_detail as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" height="200px" src="{{asset("upload_file")}}/{{$item->barang->gambar}}" alt="">
                            <div class="card-body">
                                <h5 class="card-title" class="item_nama">{{$item->barang->nama_barang}}</h5>
                                <h6 class="car-text">Tanggal Pesan : {{$item->pesanan->tanggal}}</h6>
                                <h6 class="card-text float-right">Jumlah : {{($item->jumlah)}}</h6>
                                <h6 class="card-text float-left">Rp.{{number_format($item->jumlah_harga)}}</h6>
                                <br>
                                <form action="{{route("barang.batal",$item->id)}}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger btn-block mt-1"><i class="fa fa-trash" aria-hidden="true"></i> Batalkan pesanan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            <div class="row justify-content-center">
                <span class="badge badge-primary" style="height:35px;width:300px;border-radius:5px">Total : Rp.{{number_format($pesanan->jumlah_harga)}}</span>
            </div>
            <br>
            <div class="row justify-content-center">
                <a href="{{route("barang.confirm")}}"><button class="btn btn-warning btn-block"  style="width:300;" type="button"><i class="fa fa-shopping-cart"></i> Check Out</button></a>
            </div>
        @endif
</div>
@endsection