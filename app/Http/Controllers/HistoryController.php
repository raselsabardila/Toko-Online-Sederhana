<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\Pesanan_Detail;
use App\User;
use Illuminate\Http\Request;
use Auth;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user=Auth::user();
        $pesanan=Pesanan::where("user_id",Auth::id())->where("status","!=",0)->get();
        $range=0;
        return view("admin.history.index",compact("pesanan","user","range"));
    }

    public function detail($id){
        $pesanan=Pesanan::where("id",$id)->first();
        $user=Auth::user();
        $pesanan_detail=Pesanan_Detail::where("pesanan_id",$pesanan->id)->get();

        return view("admin.history.detail",compact("pesanan","pesanan_detail","user"));   
    }
}
