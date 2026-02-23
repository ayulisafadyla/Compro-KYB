<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions
        $permissions = [
            ['name' => 'Manage Beranda', 'slug' => 'manage-beranda'],
            ['name' => 'Manage Produk', 'slug' => 'manage-produk'],
            ['name' => 'Manage Event', 'slug' => 'manage-event'],
            ['name' => 'Manage Static Pages', 'slug' => 'manage-static'],
            ['name' => 'Manage Settings', 'slug' => 'manage-settings'],
            ['name' => 'Manage Aktivitas', 'slug' => 'manage-aktivitas'],
        ];

        foreach ($permissions as $perm) {
            \App\Models\Permission::updateOrCreate(['slug' => $perm['slug']], $perm);
        }

        // Roles
        $superAdmin = \App\Models\Role::updateOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Administrator']
        );

        $admin = \App\Models\Role::updateOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Administrator']
        );

        $contentEditor = \App\Models\Role::updateOrCreate(
            ['slug' => 'content-editor'],
            ['name' => 'Content Editor']
        );

        // Assign all permissions to Super Admin
        $superAdmin->permissions()->sync(\App\Models\Permission::all());

        // Administrator can manage content but not settings/users
        $admin->permissions()->sync(
            \App\Models\Permission::whereIn('slug', [
                'manage-beranda',
                'manage-produk',
                'manage-event',
                'manage-static'
            ])->get()
        );

        // Main Super Admin
        $user = \App\Models\User::updateOrCreate(
            ['username' => '240215'],
            [
                'name' => 'Super Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role_id' => $superAdmin->id
            ]
        );

        // Normal Admin for testing
        \App\Models\User::updateOrCreate(
            ['username' => 'admin_test'],
            [
                'name' => 'Test Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role_id' => $admin->id
            ]
        );
    }
}
