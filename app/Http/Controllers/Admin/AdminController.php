<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function AdminUpdatePassword(Request $request){
        
        // update password
        if($request -> isMethod('post')){
            // dd($request -> all()); die;
            // checking valid current password
            if(Hash::check($request -> current_pass, Auth::guard('admin') -> user() -> password)){
                // checking new pass or confirm pass matchig
                if($request -> new_pass == $request -> confirm_pass){
                    // update password
                    Admin::find(Auth::guard('admin') -> user() -> id) -> update(['password' => bcrypt($request -> confirm_pass)]);

                    return redirect() -> back() -> with('update_pass', 'Update Password Successfully !');
                }else {
                    return redirect() -> back() -> with('pass_match_error', 'New Password or Confirm Password Doesn\'t match !');
                }
            }else {
                return redirect() -> back() -> with('current_pass_error', 'Current Password Incorrect !');
            }
        }
        $adminData = Admin::where(['email' => Auth::guard('admin') -> user() -> email]) -> first() -> toArray();

        return view('admin.admin_details.admin_update_password', compact('adminData'));
    }


    // checking valid current password
    public function AdminCurrentPassCheck(Request $request){
        $current_pass = $request -> current_pass;
        $loggedIn_user = Admin::find(Auth::guard('admin') -> user() -> id);

        if(Hash::check($current_pass, $loggedIn_user -> password)){
            return [
                'status'        => 'true',
                'message'       => 'Correct Password',
                'type'          => 'success'
            ];
        }else {
            return [
                'status'        => 'false',
                'message'       => 'Incorrect Password',
                'type'          => 'danger'
            ];
        }
        

     
    }



    // Admin logout
    public function AdminLogout(){
        Auth::guard('admin') -> logout();
        return redirect('admin/login');
    }




    
}
