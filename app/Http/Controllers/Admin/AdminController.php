<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin dash view
    public function AdminDashView (){
        return view('admin/dashboard');
    }
}
