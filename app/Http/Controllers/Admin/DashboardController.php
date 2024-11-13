<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

        

        public function home(){
           
            return view('admin.dashboard',compact('listsp','countSP'));
        }


   
}
