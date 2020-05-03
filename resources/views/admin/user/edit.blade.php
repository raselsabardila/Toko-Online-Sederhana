@extends('templates_backend.home')
@section("sub-title","Edit User")

@section('content')
    <center><img src="{{asset("upload_file/$user->foto")}}" width="150px" height="150px" style="border-radius:50%" alt=""></center>
    <form action="{{route('user.update',$user)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="form-group">
            <label for="name">Name : </label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Email : </label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" readonly>
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="permission">Permission : </label>
            <select name="permission" id="" class="form-control" name="permission">
                <option value="">Pilih Permission</option>
                @if(Auth::user()->permission=="admin")
                <option value="admin" 
                        @if ($user->permission == "admin")
                        selected
                        @endif
                        >Administrator</option>
                    @endif
                <option value="penjual"
                    @if ($user->permission == "penjual")
                        selected
                    @endif
                >Penjual</option>
                <option value="pembeli"
                    @if ($user->permission == "pembeli")
                        selected
                    @endif
                >Pembeli</option>
            </select>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP : </label>
            <input type="number" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{$user->nohp}}"> 
            @error('nohp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="alamat">Alamat : </label>
            <input type="string" class="form-control @error('nohp') is-invalid @enderror" name="alamat" value="{{$user->alamat}}">
            @error('nohp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password : (kosongkan bila tidak akan diganti)</label>
            <input type="password" class="form-control" name="password"> 
        </div>
        <div class="form-group">
            <label for="foto">Foto : (kosongkan bila tidak akan diganti)</label>
            <input type="file" class="form-control" name="foto"> 
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Edit Data</button>
        </div>
    </form>
@endsection