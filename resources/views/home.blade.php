@extends('templates_backend.home')

@section("sub-title")

@section('content')

<div class="container">
    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{session("status")}}
        </div>
    @endif
    <div class="row">
        @foreach ($barang as $item)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" height="200px" src="{{asset("upload_file/$item->gambar")}}" alt="">
                    <div class="card-body">
                        <h5 class="card-title" class="item_nama">{{$item->nama_barang}}</h5>
                        <h6 class="car-text">{!!$item->keterangan!!}</h6>
                        <h6 class="card-text float-right">Stok : {{($item->stok)}}</h6>
                        <h6 class="card-text float-left">Rp.{{number_format($item->harga)}}</h6>
                        <br>
                        @if ($item->stok>0)
                            <a href="{{route("barang.show",$item)}}" class="btn btn-primary btn-block" style="clear:both"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Pesan Barang</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$barang->links()}}
</div>

@endsection
