<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
            'acc_type' => 'superadmin',
            'role_access' => 'Users,Category,Sub-Category,Suggestion,State,City,Locality,Auto Cars,Properties,Mobiles,Jobs,Bikes,Electronic Appliances,Furniture,Fashion,Education & Training,Pets',
        ]);
    }
}
