<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
                'id'        => 2,
                'name'      => 'Jhon smith',
                'vendor_id' => 1,
                'type'      => 'vendor',
                'email'     => 'vendor@gmail.com',
                'password'  => '$2a$12$7FBvqhphCnfshO0oQTDP6.WRNMm1OtUrJ9vz/ZqFYBOpv/SDitSWi', // 112233
            ]
        ];

        Admin::insert($data);
    }
}
