<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';
    
    protected $guarded = [];


    // get data from vendor table
    public function GetVendorData(){
        return $this -> belongsTo(Vendor::class, 'vendor_id');
    }

    // get data from vendor business table
    public function GetVendorBusinessData(){
        return $this -> belongsTo(VendorBusinessDetails::class, 'vendor_id');
    }

    // get data from vendor bank table
    public function GetVendorBankData(){
        return $this -> belongsTo(VendorBankDetails::class, 'vendor_id');
    }

}
