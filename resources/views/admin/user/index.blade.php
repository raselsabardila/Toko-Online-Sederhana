@extends('templates_backend.home')

@section("sub-title","User Page")

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($user2 as $item)
                <div class="col-md-4">
                    <div class="card">
                        <img class="" src="{{asset("upload_file/$item->foto")}}" height="250px" alt="foto">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <h6 class="card-text">{{$item->email}}</h6>
                            <form action="{{route("user.destroy",$item)}}" method="post">
                                @csrf
                                @method("delete")

                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection