@extends('templates_backend.home')

@section("sub-title","Detail Barang $barang->nama_barang")

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img class="rounded mx-auto d-block" width="100%" src="{{asset("upload_file/$barang->gambar")}}" alt="">
                    <br>
                </div>
                <div class="col-md-6">
                    <h3 class="text-center">{{$barang->nama_barang}}</h3>
                    <table class="table table-light table-hover">
                        <tbody>
                            <tr>
                                <td scope="row"><h6>Harga</h6></td>
                                <td><h6>:</h6></td>
                                <td><h6>Rp.{{number_format($barang->harga)}}</h6></td>
                            </tr>
                            <tr>
                                <td scope="row"><h6>Stok</h6></td>
                                <td><h6>:</h6></td>
                                <td><h6>{{$barang->stok}}</h6></td>
                            </tr>
                            <tr>
                                <td scope="row"><h6>Keterangan</h6></td>
                                <td><h6>:</h6></td>
                                <td><h6>{!!$barang->keterangan!!}</h6></td>
                            </tr>
                            @if ($barang->stok>0)
                                <form action="{{route("barang.pesan",$barang->id)}}" method="post">
                                    @csrf
                                    <tr>
                                        <td scope="row"><h6>Jumlah Pesan</h6></td>
                                        <td><h6>:</h6></td>
                                        <td><h6><input type="number" min="0" max="{{$barang->stok}}" name="jumlah_pesan" class="form-control"></h6></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><button class="btn btn-primary btn-block" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Masukan Ke Troli</button></td>
                                    </tr>
                                </form>
                            @endif
                            <tr>
                                <td colspan="3"><a href="{{route("home")}}"><button class="btn btn-danger btn-block" type="submit"><i class="fa fa-arrow-left" aria-hidden="true"></i>Kembali</button></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection