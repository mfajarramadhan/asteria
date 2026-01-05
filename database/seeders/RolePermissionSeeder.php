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
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Admin Riksa Uji']);
        $petugasRole = Role::create(['name' => 'Tim Riksa Uji']);
        $penyusunLHPRole = Role::create(['name' => 'Penyusun LHP']);

        // 2. Create Permissions
        Permission::create(['name' => 'manage job orders']);   // CRUD JO
        Permission::create(['name' => 'manage form_kp']);      // CRUD form KP
        Permission::create(['name' => 'view only']);           // Read-only
        Permission::create(['name' => 'manage users']);        // khusus owner

        // 3. Assign Permissions to Roles
        $superAdminRole->givePermissionTo(Permission::all()); // Owner punya semua
        $adminRole->givePermissionTo(['manage job orders', 'view only']);
        $petugasRole->givePermissionTo(['manage form_kp']);
        $penyusunLHPRole->givePermissionTo(['view only']);

        // 4. Create Super Owner
        $userSuperAdmin = User::create([
            'nama' => 'Simpelkanaker',
            'email' => 'simpelnaker@gmail.com',
            'id_user' => '0001',
            'jabatan' => 'Admin Utama',
            'avatar' => 'avatars/default.png',
            'password' => bcrypt('kepatuhan'),
        ]);

        $userSuperAdmin->assignRole($superAdminRole);
    }
}
