<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->permission=="pembeli" || Auth::user()->permission=="penjual") {
            return redirect()->route("home");
        }
        $user2=User::get();
        $user=Auth::user();
        return view("admin.user.index",compact("user2","user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        if (Auth::id()!=$user->id) {
            return redirect()->route("home");
        }else{
            return view("admin.user.edit",compact("user"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "nohp"=>"required",
            "alamat"=>"required",
            "permission"=>"required",
        ]);

        if($request->password ==null && $request->foto == null){
            $user=User::find($id);
            $user->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "alamat"=>$request->alamat,
                "nohp"=>$request->nohp,
                "permission"=>$request->permission
            ]);

            return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil di Update");
        }
        else if ($request->foto == null) {
            $user=User::find($id);
            $user->update([
                "name"=>$request->name,
                "password"=>bcrypt($request->password),
                "email"=>$request->email,
                "alamat"=>$request->alamat,
                "nohp"=>$request->nohp,
                "permission"=>$request->permission
            ]);
            return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil di Update");
        }
        else if ($request->password == null) {
            $file=$request->file("foto");
            $nama_file=$file->getClientOriginalName();
            $extension=$file->getClientOriginalExtension();
            $size=$file->getSize();

            $format=["jpg","png","jpeg","svg","gif"];
            $destination="upload_file";
            $nama_file_split=explode(".",$nama_file);
            $nama_file_split[0]=uniqid($nama_file_split[0]);
            if(!in_array($nama_file_split[1],$format)){
                return redirect()->route("barang.create")->with("status","Format file tidak mendukung");
            }
            $namaasli="";
            $namaasli .= $nama_file_split[0];
            $namaasli .= ".";
            $namaasli .= $nama_file_split[1];

            $file->move($destination,$namaasli);

            $user=User::find($id);
            $user->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "alamat"=>$request->alamat,
                "nohp"=>$request->nohp,
                "foto"=>$namaasli,
                "permission"=>$request->permission
            ]);

            return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil di Update");
        }

        $file=$request->file("foto");
        $nama_file=$file->getClientOriginalName();
        $extension=$file->getClientOriginalExtension();
        $size=$file->getSize();

        $format=["jpg","png","jpeg","svg","gif"];
        $destination="upload_file";
        $nama_file_split=explode(".",$nama_file);
        $nama_file_split[0]=uniqid($nama_file_split[0]);
        if(!in_array($nama_file_split[1],$format)){
            return redirect()->route("barang.create")->with("status","Format file tidak mendukung");
        }
        $namaasli="";
        $namaasli .= $nama_file_split[0];
        $namaasli .= ".";
        $namaasli .= $nama_file_split[1];

        $file->move($destination,$namaasli);

        $user=User::find($id);
        $user->update([
            "name"=>$request->name,
            "password"=>bcrypt($request->password),
            "email"=>$request->email,
            "alamat"=>$request->alamat,
            "nohp"=>$request->nohp,
            "foto"=>$namaasli,
            "permission"=>$request->permission
        ]);

        return redirect()->route("user.edit",["user"=>$user])->with("status","Profile Berhasil di Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user->find($id);
        $user->delete();

        return redirect()->route("admin.user.index")->with("status","Profile Berhasil di Delete");
    }
}
