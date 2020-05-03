@extends('templates_backend.home')

@section("sub-title","History Pemesanan");

@section('content')
@if (session("status"))
    <div class="alert alert-danger" role="alert">
        {{session("status")}}
    </div>
@endif
<div class="container">
    <table class="table table-hover table-responsive">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Jumlah Harga</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanan as $item )
                <tr>
                    <td>{{$range+=1}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        @if ($item->status==1)
                            Pesanan Belum Dibayar
                        @else
                            Pesanan Sudah Dibayar
                        @endif
                    </td>
                    <td>{{$item->jumlah_harga}}</td>
                    <td><a href="{{route("history.detail",$item->id)}}"><button class="btn btn-primary" type="button">Detail</button></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection