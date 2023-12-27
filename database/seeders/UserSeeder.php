<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // User
            ['guard_name' => 'web', 'name' => 'index-user'],
            ['guard_name' => 'web', 'name' => 'create-user'],
            ['guard_name' => 'web', 'name' => 'edit-user'],
            ['guard_name' => 'web', 'name' => 'destroy-user'],
            // Ruang Meeting
            ['guard_name' => 'web', 'name' => 'index-ruang-meeting'],
            ['guard_name' => 'web', 'name' => 'create-ruang-meeting'],
            ['guard_name' => 'web', 'name' => 'edit-ruang-meeting'],
            ['guard_name' => 'web', 'name' => 'destroy-ruang-meeting'],
            // Waktu Meeting
            ['guard_name' => 'web', 'name' => 'index-waktu-meeting'],
            ['guard_name' => 'web', 'name' => 'create-waktu-meeting'],
            ['guard_name' => 'web', 'name' => 'edit-waktu-meeting'],
            ['guard_name' => 'web', 'name' => 'destroy-waktu-meeting'],
            // Jenis Konsumsi
            ['guard_name' => 'web', 'name' => 'index-jenis-konsumsi'],
            ['guard_name' => 'web', 'name' => 'create-jenis-konsumsi'],
            ['guard_name' => 'web', 'name' => 'edit-jenis-konsumsi'],
            ['guard_name' => 'web', 'name' => 'destroy-jenis-konsumsi'],
            // Meeting
            ['guard_name' => 'web', 'name' => 'index-meeting'],
            ['guard_name' => 'web', 'name' => 'create-meeting'],
            ['guard_name' => 'web', 'name' => 'edit-meeting'],
            ['guard_name' => 'web', 'name' => 'destroy-meeting'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // create Roles
        $roles = [
            ['guard_name' => 'web', 'name' => 'Super Admin'],
            ['guard_name' => 'web', 'name' => 'Admin Unit'],
            ['guard_name' => 'web', 'name' => 'Pegawai'],
        ];

        foreach ($roles as $role) {
            $created_role = Role::create($role);

            if ($created_role->name == 'Admin Unit') {
                $created_role->givePermissionTo('index-meeting');
                $created_role->givePermissionTo('create-meeting');
                $created_role->givePermissionTo('edit-meeting');
                $created_role->givePermissionTo('destroy-meeting');
            }

            if ($created_role->name == 'Pegawai') {
                $created_role->givePermissionTo('index-meeting');
                $created_role->givePermissionTo('create-meeting');
                $created_role->givePermissionTo('edit-meeting');
                $created_role->givePermissionTo('destroy-meeting');
            }
        }

        $users = [
            [
                'nama' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@pln.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'nama' => 'Admin Unit',
                'username' => 'adminunit',
                'email' => 'adminunit@pln.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
            [
                'nama' => 'Pegawai',
                'username' => 'pegawai',
                'email' => 'pegawai@pln.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            $created_user = User::create($user);
            $created_user->assignRole($created_user->nama);
        }
    }
}
