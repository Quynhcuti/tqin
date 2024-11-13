<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HoaController extends Controller
{
   public function index()
   {

    //hiển thị 6 bài viết mới nhất
    $hoa = DB::table('hoas')
    ->orderByDesc('id')
    ->limit(6)
    ->get();

    //hiển thị ra view
       return view('index', compact('hoa'));
   }
   //chi tiết sản phẩm

   public function detail($id)
   {
       $hoa = DB::table('hoas')
       ->where('id', $id)
       ->first();
       return view('detail', compact('hoa'));
   }

   //hiển thị danh sách theo loại

   public function listSP($id)
   {
       $hoa = DB::table('hoas')
       ->where('category_id', $id)
       ->get();
       return view('listSP', compact('hoa'));
   }

   
}
