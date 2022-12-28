<?php

namespace Database\Seeders;

use App\Models\VendorBusinessDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBusinessDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // insert data
         $data = [
            [
                'id'        => 1,
                'vendor_id'     => 1,
                'shop_name'      => 'Jhon smith',
                'shop_address' => 'sharita electronics',
                'shop_city'      => 'dhaka',
                'shop_state'     => 'rampura',
                'shop_country'  => 'bangaldesh',
                'shop_pincode'  => '1219',
                'shop_mobile'  => '556589595',
                'shop_website'  => 'sharita.com',
                'shop_email'  => 'sharita@gmail.com',
                'address_proof'  => 'wapda road',
                'address_proof_image'  => '',
                'business_license_number'  => '',
                'gst_number'  => '',
                'pan_number'  => '',
            ]
        ];

        VendorBusinessDetails::insert($data);
    }
}
