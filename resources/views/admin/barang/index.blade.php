@extends('templates_backend.home')

@section("sub-title","List Barang")

@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{session("status")}}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <table class="table table-hover table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Stok Barang</th>
                        <th>Harga Barang</th>
                        <th>Keterangan Barang</th>
                        <th>Pemilik</th>
                        <th>foto Barang</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $item =>$hasil)
                            @if (Auth::user()->permission == "admin")
                                <tr>
                                    <td>{{$item+$barang->firstitem()}}</td>
                                    <td>{{$hasil->nama_barang}}</td>
                                    <td>{{$hasil->stok}}</td>
                                    <td>{{$hasil->harga}}</td>
                                    <td>{!!$hasil->keterangan!!}</td>
                                    <td>{{$hasil->user->name}}</td>
                                    <td><img src="{{asset("upload_file/$hasil->gambar")}}" width="150px" alt=""></td>
                                    <td>
                                        <a href="{{route("barang.edit",$hasil)}}"><button class="btn btn-warning" type="button">Update</button></a>
                                        <form action="{{route("barang.destroy",$hasil)}}" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                            @if ($hasil->user->name == Auth::user()->name && Auth::user()->permission == "penjual")
                                <tr>
                                    <td>{{$item+$barang->firstitem()}}</td>
                                    <td>{{$hasil->nama_barang}}</td>
                                    <td>{{$hasil->stok}}</td>
                                    <td>{{$hasil->harga}}</td>
                                    <td>{!!$hasil->keterangan!!}</td>
                                    <td>{{$hasil->user->name}}</td>
                                    <td><img src="{{asset("upload_file/$hasil->gambar")}}" width="150px" alt=""></td>
                                    <td>
                                        <a href="{{route("barang.edit",$hasil)}}"><button class="btn btn-warning" type="button">Update</button></a>
                                        <form action="{{route("barang.destroy",$hasil)}}" method="post">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    {{$barang->links()}}
    
@endsection