<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
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
                'name'      => 'Vendor One',
                'email'     => 'vendor@gmail.com'
            ]
        ];

        Vendor::insert($data);
    }
}
