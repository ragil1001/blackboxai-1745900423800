<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Pegawai; 

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles with API guard - this matches your default guard
        $role_admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $role_cs = Role::firstOrCreate(['name' => 'cs', 'guard_name' => 'api']);
        
        // Create permissions with API guard
        $permission_manage_pegawai = Permission::firstOrCreate(['name' => 'manage-pegawai', 'guard_name' => 'api']);
        $permission_manage_jabatan = Permission::firstOrCreate(['name' => 'manage-jabatan', 'guard_name' => 'api']);
        $permission_manage_organisasi = Permission::firstOrCreate(['name' => 'manage-organisasi', 'guard_name' => 'api']);
        $permission_manage_merchandise = Permission::firstOrCreate(['name' => 'manage-merchandise', 'guard_name' => 'api']);
        $permission_manage_penitip = Permission::firstOrCreate(['name' => 'manage-penitip', 'guard_name' => 'api']);

        // Sync permissions to roles
        $role_admin->syncPermissions([
            $permission_manage_pegawai,
            $permission_manage_jabatan,
            $permission_manage_organisasi,
            $permission_manage_merchandise
        ]);
        
        $role_cs->syncPermissions([
            $permission_manage_penitip
        ]);

        // Assign role to pegawai (if exists)
        $pegawai = Pegawai::find(15);
        if ($pegawai) {
            $pegawai->syncRoles([$role_admin]);
        }
    }
}