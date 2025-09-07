<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugasRole = Role::where('name', 'petugas')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $penyusunLHPRole = Role::where('name', 'penyusunLHP')->first();

        $userPetugas = User::create([
            'nama'      => 'Rendi',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'rendi@gmail.com',
            'password'  => Hash::make('rendi12345'), // ganti sesuai kebutuhan
        ]);

        $userPetugas2 = User::create([
            'nama'      => 'Bayu',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'bayu@gmail.com',
            'password'  => Hash::make('bayu12345'),
        ]);

        $userPetugas3 = User::create([
            'nama'      => 'Alben',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'alben@gmail.com',
            'password'  => Hash::make('alben12345'),
        ]);

        $userPetugas4 = User::create([
            'nama'      => 'Sarip',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'sarip@gmail.com',
            'password'  => Hash::make('sarip12345'),
        ]);

        $userAdmin = User::create([
            'nama'      => 'Maul',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'maul@gmail.com',
            'password'  => Hash::make('maul12345'),
        ]);

        $userAdmin2 = User::create([
            'nama'      => 'Heri',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'heri@gmail.com',
            'password'  => Hash::make('heri12345'),
        ]);

        $userPenyusunLHP = User::create([
            'nama'      => 'Intan',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'intan@gmail.com',
            'password'  => Hash::make('intan12345'),
        ]);

        $userPenyusunLHP2 = User::create([
            'nama'      => 'Sarah',
            'jabatan'   => 'AK3',
            'avatar'    => 'images/default-avatar.png',
            'email'     => 'sarah@gmail.com',
            'password'  => Hash::make('sarah12345'),
        ]);

        $userPetugas->assignRole($petugasRole);
        $userPetugas2->assignRole($petugasRole);
        $userPetugas3->assignRole($petugasRole);
        $userPetugas4->assignRole($petugasRole);
        $userAdmin->assignRole($adminRole);
        $userAdmin2->assignRole($adminRole);
        $userPenyusunLHP->assignRole($penyusunLHPRole);
        $userPenyusunLHP->assignRole($penyusunLHPRole);

    }
}
