<?php

namespace Database\Seeders;

use App\Models\VendorBankDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankDetailsSeeder extends Seeder
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
                'account_holder_number' => 'farid uddin',
                'bank_name'      => 'DBBL',
                'account_number'     => '1659835698',
                'bank_ifsc_code'     => '2535',
            ]
        ];

        VendorBankDetails::insert($data);
    }
}
