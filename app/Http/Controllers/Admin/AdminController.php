<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Category::paginate(10);
        return view('admin.dashboard');
    }

    public function show($id){
        $users = User::query()
        ->select('users.*')
        ->findOrFail($id);
        return view('admin.users.show',compact('users'));
    }
}
