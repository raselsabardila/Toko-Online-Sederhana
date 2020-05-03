<?php

namespace App\Http\Controllers;

use App\Barang;
use Auth;
use Alert;
use App\Pesanan;
use App\Pesanan_Detail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangController extends Controller
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
        if (Auth::user()->permission=="pembeli") {
            return redirect()->route("home");
        }
        $user=Auth::user();
        $barang=Barang::latest()->paginate(10);
        return view("admin.barang.index",compact("barang","user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        if (Auth::user()->permission=="pembeli") {
            return redirect()->route("home");
        }
        $user=Auth::user();
        return view("admin.barang.create",compact("user"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama_barang"=>"required",
            "stok"=>"required",
            "harga"=>"required",
            "gambar"=>"required",
            "keterangan"=>"required"
        ]);

        $file=$request->file("gambar");
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

        Barang::create([
            "nama_barang"=>$request->nama_barang,
            "stok"=>$request->stok,
            "harga"=>$request->harga,
            "gambar"=>$namaasli,
            "keterangan"=>$request->keterangan,
            "user_id"=>Auth::id()
        ]);

        return redirect()->route("barang.index")->with("status","Data Behasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        $user=Auth::user();
        return view("admin.barang.show",["barang"=>$barang,"user"=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        if (Auth::user()->permission=="pembeli") {
            return redirect()->route("home");
        }elseif(Auth::user()->permission=="penjual" && $barang->user->name != Auth::user()->name){
            return redirect()->route("home");
        }
        $user=Auth::user();
        return view("admin.barang.edit",["barang"=>$barang,"user"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            "nama_barang"=>"required",
            "stok"=>"required",
            "harga"=>"required",
            "keterangan"=>"required"
        ]);

        if($request->gambar == null){
            $barang->update([
                "nama_barang"=>$request->nama_barang,
                "stok"=>$request->stok,
                "harga"=>$request->harga,
                "keterangan"=>$request->keterangan
                ]);
                return redirect()->route("barang.index")->with("status","Data Barang Berhasil Di Update!!");
        }else{
            $file=$request->file("gambar");
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

            $barang->update([
                "nama_barang"=>$request->nama_barang,
                "stok"=>$request->stok,
                "harga"=>$request->harga,
                "keterangan"=>$request->keterangan,
                "gambar"=>$namaasli
                ]);
                
                return redirect()->route("barang.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route("barang.index")->with("status","Data Barang Berhasil Di Hapus");
    }

    public function pesan(Request $request,$id){
        $barang=Barang::find($id);
        
        $status=0;
        $cekpesanan=Pesanan::where("user_id",Auth::id())->where("status",0)->first();

        if (empty($cekpesanan)) {
            $pesanan=new \App\Pesanan;
            $pesanan->user_id=Auth::id();
            $pesanan->tanggal=Carbon::now();
            $pesanan->status=$status;
            $pesanan->jumlah_harga=0;
            $pesanan->kode=mt_rand(0,999);
            $pesanan->save();
        }

        $pesanan_baru=Pesanan::where("user_id",Auth::id())->where("status",0)->first();
        $cek_pesanan_detail=Pesanan_Detail::where("barang_id",$barang->id)->where("pesanan_id",$pesanan_baru->id)->first();

        if (empty($cek_pesanan_detail)) {
            $pesanan_detail=new Pesanan_Detail;
            $pesanan_detail->barang_id=$barang->id;        
            $pesanan_detail->pesanan_id=$pesanan_baru->id;
            $pesanan_detail->jumlah=$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga=$barang->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        }else{
            $pesanan_detail=Pesanan_Detail::where("barang_id",$barang->id)->where("pesanan_id",$pesanan_baru->id)->first();

            $pesanan_detail->jumlah=$pesanan_detail->jumlah+$request->jumlah_pesan;
            $harga=$barang->harga*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga=$harga+$pesanan_detail->jumlha_harga;
            $pesanan_detail->update();
        }

        $pesanan=Pesanan::where("user_id",Auth::id())->where("status",0)->first();
        $pesanan->jumlah_harga=$pesanan->jumlah_harga+$barang->harga*$request->jumlah_pesan;
        $pesanan->update();

        return redirect()->route("home")->with("status","Barang Berhasil Masuk Ke Keranjang");
    }

    public function checkout(){
        $pesanan=Pesanan::where("user_id",Auth::id())->where("status",0)->first();
        if (!empty($pesanan)) {
            $user=Auth::user();
            $pesanan_detail=Pesanan_Detail::where("pesanan_id",$pesanan->id)->get();
            return view("admin.barang.checkout",compact("pesanan","pesanan_detail","user"));
        }elseif(empty($pesanan)){
            $user=Auth::user();
            return view("admin.barang.checkout",compact("user"));
        }
    }

    public function batal($id){
        $pesanan_detail=Pesanan_Detail::find($id);
        $pesanan=Pesanan::where("id",$pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga=$pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        return redirect()->route("barang.checkout")->with("status","Pesanan Berhasil Dibatalakn");
    }

    public function confirm(){
        $pesanan=Pesanan::where("user_id",Auth::id())->where("status",0)->first();
        $pesanan_detail=Pesanan_Detail::where("pesanan_id",$pesanan->id)->get();
        $pesanan->status=1;
        $pesanan->update();
        foreach ($pesanan_detail as $key) {
            $barang=Barang::where("id",$key->barang_id)->first();
            $barang->stok=$barang->stok-$key->jumlah;
            $barang->update();
        }

        return redirect()->route("barang.checkout")->with("status","Pesanan Berhasil Di Check Out");
    } 
}
