<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin dash view
    public function AdminDashView (){
        return view('admin.dashboard');
    }


    // Admin Login view
    public function AdminLoginView (Request $request){

        // login admin
        if($request -> isMethod('post')){
                // dd($request -> all()); die;

            // validation
            $this -> validate($request, [
                'email'     => 'required|email|max:255',
                'password'  => 'required'
            ]);    

            // Valid admin checking
            if(Auth::guard('admin') -> attempt(['email' => $request -> email, 'password' => $request -> password, 'status' => 1])){
                return redirect('admin/dashboard');
            }else {
                return redirect() -> back() -> with('error_message', 'Email or Password Invalid !');
            }
        }

        return view('admin.adminlogin');
    }


    // Admin Update Password
    public function AdminUpdatePassword(){
        $adminData = Admin::where(['email' => Auth::guard('admin') -> user() -> email]) -> first() -> toArray();

        return view('admin.admin_details.admin_update_password', compact('adminData'));
    }



    // Admin logout
    public function AdminLogout(){
        Auth::guard('admin') -> logout();
        return redirect('admin/login');
    }




    
}
