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
                'id'        => 1,
                'name'      => 'Super Admin',
                'type'      => 'superadmin',
                'email'     => 'admin@gmail.com',
                'password'  => '$2a$12$7FBvqhphCnfshO0oQTDP6.WRNMm1OtUrJ9vz/ZqFYBOpv/SDitSWi', // 112233
            ]
        ];

        Admin::insert($data);
    }
}
