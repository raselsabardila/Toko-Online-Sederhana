@extends('templates_backend.home')

@section("sub-title","Tambah Barang")

@section('content')

    @if (session("status"))
        <div class="alert alert-success" role="alert">
            {{session("status")}}
        </div>
    @endif

    <form action="{{route("barang.update",$barang)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("patch")
        
        <div class="form-group">
            <label for="nama_barang">Nama Barang : </label>
            <input id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" type="text" name="nama_barang" value="{{$barang->nama_barang}}">
            @error("nama_barang")
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nama_barang">Harga : </label>
            <input id="nama_barang" class="form-control  @error('harga') is-invalid @enderror" type="number" name="harga" value="{{$barang->harga}}">
            @error("harga")
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="stok">Stok Barang : </label>
            <input id="stok" class="form-control @error('stok') is-invalid @enderror" type="number" name="stok" value="{{$barang->stok}}">
            @error("stok")
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="keterangan">Keterengan Barang : </label>
            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" cols="30" rows="10">{!!$barang->keterangan!!}</textarea>
            @error("keterangan")
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <img src="{{asset("upload_file/$barang->gambar")}}" width="250px" alt="" srcset="">
            <br><br>
            <label for="gambar">Foto Barang : (Kosongkan bila tidak akan diganti!!)</label>
            <input id="gambar" class="form-control" type="file" name="gambar">
        </div>
        <button class="btn btn-primary btn-block" type="submit">Update Barang</button>
    </form>

    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'keterangan' );
    </script>
@endsection