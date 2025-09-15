<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Roles
        $ownerRole = Role::create(['name' => 'owner']);
        $adminRole = Role::create(['name' => 'admin']);
        $petugasRole = Role::create(['name' => 'petugas']);
        $penyusunLHPRole = Role::create(['name' => 'penyusunLHP']);

        // 2. Create Permissions
        Permission::create(['name' => 'manage job orders']);   // CRUD JO
        Permission::create(['name' => 'manage form_kp']);      // CRUD form KP
        Permission::create(['name' => 'view only']);           // Read-only
        Permission::create(['name' => 'manage users']);        // khusus owner

        // 3. Assign Permissions to Roles
        $ownerRole->givePermissionTo(Permission::all()); // Owner punya semua

        $adminRole->givePermissionTo(['manage job orders', 'view only']);
        $petugasRole->givePermissionTo(['manage form_kp']);
        $penyusunLHPRole->givePermissionTo(['view only']);

        // 4. Create Super Owner
        $userOwner = User::create([
            'nama' => 'Muh Fajar',
            'jabatan' => 'Manager',
            'avatar' => 'images/default-avatar.png',
            'email' => 'fajar@owner.com',
            'password' => bcrypt('fajar12345'),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
