<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Role;
use DB;

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
        DB::table('admin_role')->truncate();

        $superadminRole = Role::where('acc_type', 'superadmin')->first();
        $adminRole = Role::where('acc_type', 'admin')->first();
        $superadmin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'),
            'acc_type' => 'superadmin',
            'role_access' => '',
        ]);

        $admin = Admin::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('user@user.com'),
            'acc_type' => 'superadmin',
            'role_access' => 'category,subcategory',
        ]);
        $superadmin->roles()->attach($superadminRole);
        $admin->roles()->attach($adminRole);
    }
}
