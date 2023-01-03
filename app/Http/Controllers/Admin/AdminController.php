<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorBankDetails;
use App\Models\VendorBusinessDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

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

        return view('admin.settings.admin_update_password', compact('adminData'));
    }

    // Admin Update Details
    public function AdminUpdateDetails(Request $request){
    
        // update details
        if($request -> isMethod('post')){
            // dd($request -> all()); die;

            // validation
            $this -> validate($request,[
                'name'          => 'required',
                'email'         => 'required|email'
            ]);

            // image upload
            if($request -> hasFile('image')){
                $img = $request -> file('image');
                $unique_name = md5(time().rand()).'.'.$img -> getClientOriginalExtension();
                // $image_path = $img -> move(public_path('media/admin/admin_photo'), $unique_name);

                // image path with location
                $image_path = 'media/admin/admin_photo/'.$unique_name;
                Image::make($img) -> save('media/admin/admin_photo/'. $unique_name);

                // delete old image
                @unlink($request -> old_image);
            }else {
                $image_path = $request -> old_image;
            }
            
            // update details
            Admin::find(Auth::guard('admin') -> user() -> id) -> update([
                'name'      => $request -> name,
                'email'     => $request -> email,
                'mobile'    => $request -> mobile,
                'image'     => $image_path,
                
            ]);
           
            return redirect() -> back() -> with('success_message', 'Updated Admin Details !');
        }
        
        $adminData = Admin::where(['id' => Auth::guard('admin') -> user() -> id]) -> first() -> toArray();

        return view('admin.settings.admin_update_details', compact('adminData'));
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


    // Update vendor details 
    public function VendorDetailsUpdate(Request $request, $slug){
        if($slug == 'personal'){
            // get vendor personal info
            $vendorData = Vendor::where('id', Auth::guard('admin') -> user() -> vendor_id) -> first() -> toArray();
            // dd($vendorData); die;

            // Vendor Personal Details update
            if($request -> isMethod('post')){
                // dd($request -> all()); die;
                // validation
                $this -> validate($request, [
                    'name'      => 'required',
                    'email'     => 'required|email',
                ]);

                // image upload
                if($request -> hasFile('image')){
                    $img = $request -> file('image');
                    $unique_name = md5(time().rand()).'.'.$img -> getClientOriginalExtension();
                    // $image_path = $img -> move(public_path('media/admin/vendor_photo'), $unique_name);

                    // image path with location
                    $image_path = 'media/admin/vendor_photo/'.$unique_name;
                    Image::make($img) -> save('media/admin/vendor_photo/'. $unique_name);

                    // delete old image
                    @unlink($request -> old_image);
                }else {
                    $image_path = $request -> old_image;
                }


                // vendor personal details update in Vendor table
                Vendor::where('id', Auth::guard('admin') -> user() -> vendor_id) -> update([
                    'name'          => $request -> name,
                    'email'         => $request -> email,
                    'mobile'        => $request -> mobile,
                    'address'       => $request -> address,
                    'sate'          => $request -> sate,
                    'country'       => $request -> country,
                    'pincode'       => $request -> pincode,
                    'city'          => $request -> city
                ]);

                // vendor personal details update in Admin table
                Admin::where('id', Auth::guard('admin') -> user() -> id) -> update([
                    'name'           => $request -> name,
                    'email'          => $request -> email,
                    'image'          => $image_path
                ]);

                return redirect() -> back() -> with('success_message', 'Updated Vendor Personal Details !');
            }

        }else if($slug == 'business'){
            // get vendor business data
            $vendorData = VendorBusinessDetails::where('vendor_id', Auth::guard('admin') -> user() -> vendor_id) -> first() -> toArray();

            // Vendor Business Details update
            if($request -> isMethod('post')){
                // dd($request -> all()); die;
                // validation
                $this -> validate($request, [
                    'shop_name'             => 'required',
                    'shop_address'          => 'required',
                    'shop_city'             => 'required',
                    'shop_state'            => 'required',
                    'shop_country'          => 'required',
                    'shop_pincode'          => 'required',
                    'shop_mobile'           => 'required',
                    'shop_website'          => 'required',
                    'shop_email'            => 'required',
                    'address_proof'         => 'required',
                    'business_license_number'=> 'required',
                    'gst_number'            => 'required',
                    'pan_number'            => 'required',
                ]);

                // Address image upload
                if($request -> hasFile('address_proof_image')){
                    $img = $request -> file('address_proof_image');
                    $unique_name = md5(time().rand()).'.'.$img -> getClientOriginalExtension();
                    // $image_path = $img -> move(public_path('media/admin/vendor_photo'), $unique_name);

                    // image path with location
                    $image_path = 'media/admin/address_proof_image/'.$unique_name;
                    Image::make($img) -> save('media/admin/address_proof_image/'. $unique_name);

                    // delete old image
                    @unlink($request -> old_address_proof_image);
                }else {
                    $image_path = $request -> old_address_proof_image;
                }


                // vendor Business details update in VendorBusinessDetails table
                VendorBusinessDetails::where('vendor_id', Auth::guard('admin') -> user() -> vendor_id) -> update([
                    'vendor_id'                 => Auth::guard('admin') -> user() -> vendor_id,
                    'shop_name'                 => $request -> shop_name,
                    'shop_address'              => $request -> shop_address,
                    'shop_city'                 => $request -> shop_city,
                    'shop_state'                => $request -> shop_state,
                    'shop_country'              => $request -> shop_country,
                    'shop_pincode'              => $request -> shop_pincode,
                    'shop_mobile'               => $request -> shop_mobile,
                    'shop_website'              => $request -> shop_website,
                    'shop_email'                => $request -> shop_email,
                    'address_proof'             => $request -> address_proof, 
                    'address_proof_image'       => $image_path,
                    'business_license_number'   => $request -> business_license_number,
                    'gst_number'                => $request -> gst_number,
                    'pan_number'                => $request -> pan_number,
                ]);

                return redirect() -> back() -> with('success_message', 'Updated Vendor Business Details !');
            }
            
        }else if($slug == 'bank'){
            $vendorData = VendorBankDetails::where('vendor_id', Auth::guard('admin') -> user() -> vendor_id) -> first() -> toArray();

            // Vendor Business Details update
            if($request -> isMethod('post')){
                // dd($request -> all()); die;
                // validation
                $this -> validate($request, [
                    'account_holder_number'     => 'required',
                    'bank_name'                 => 'required',
                    'account_number'            => 'required',
                    'bank_ifsc_code'            => 'required',
                ]);

                // vendor Business details update in VendorBusinessDetails table
                VendorBankDetails::where('vendor_id', Auth::guard('admin') -> user() -> vendor_id) -> update([
                    'vendor_id'                 => Auth::guard('admin') -> user() -> vendor_id,
                    'account_holder_number'  => $request -> account_holder_number,
                    'bank_name'              => $request -> bank_name,
                    'account_number'         => $request -> account_number,
                    'bank_ifsc_code'         => $request -> bank_ifsc_code
                ]);

                return redirect() -> back() -> with('success_message', 'Updated Vendor Bank Details !');
            }
                        
        }
        

        return view('admin.settings.vendor_details_update', compact('slug', 'vendorData'));
    }


    // amdin / sub-admin / vendor management
    public function AdminManagement ($type = null){
        if($type == 'all-admin'){
            $admin = Admin::query();
            // get data
            $adminData = $admin -> where('type', 'admin') -> get();
            $title = 'Admin List';
            Session::put('page', 'admin');
            
        }else if($type == 'all-sub-admin'){
            $admin = Admin::query();
            // get data
            $adminData = $admin -> where('type', 'subadmin') -> get() -> toArray();
            $title = 'Sub-Admin List';
            Session::put('page', 'sub-admin');

        }else if($type == 'all-vendor'){
            $admin = Admin::query();
            // get data
            $adminData = $admin -> where('type', 'vendor') -> get();
            $title = 'Vendor List';
            Session::put('page', 'vendor');

        }else {
            $adminData = Admin::get();
            $title = 'All Admin Panel';
            Session::put('page', 'all-admin-data');
        }

        return view('admin.admin_mngt.admin_mngt', compact('title', 'adminData'));
    }

    // single vendor view
    public function SingleVendorView ($id){

        $title = '';
        $vendorData = Admin::with(['GetVendorData', 'GetVendorBusinessData', 'GetVendorBankData']) -> where('vendor_id', $id) -> first() -> toArray();

        // dd($vendorData); die;

        return view('admin.admin_mngt.single_vendor_view', compact('title', 'vendorData'));
    }


    // admin status update
    public function AdminStatusUpdate ($admin_id, Request $request){

        if($request -> status == 0){
            Admin::where('id', $admin_id) -> update(['status' => 1]);
            return 'active';
        }else {
             Admin::where('id', $admin_id) -> update(['status' => 0]);
            return 'inactive';
        }
    }


    // Admin logout
    public function AdminLogout(){
        Auth::guard('admin') -> logout();
        return redirect('admin/login');
    }
    
}
