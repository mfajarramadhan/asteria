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
            'id_user'     => '0001',
            'email'     => 'rendi@gmail.com',
            'jabatan'   => 'Pejabat Fungsional AK3',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('rendi12345'), // ganti sesuai kebutuhan
        ]);

        $userPetugas2 = User::create([
            'nama'      => 'Bayu',
            'id_user'     => '0002',
            'email'     => 'bayu@gmail.com',
            'jabatan'   => 'Asisten Muda AK3',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('bayu12345'),
        ]);

        $userPetugas3 = User::create([
            'nama'      => 'Alben',
            'id_user'     => '0003',
            'email'     => 'alben@gmail.com',
            'jabatan'   => 'Asisten Pertama AK3',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('alben12345'),
        ]);

        $userPetugas4 = User::create([
            'nama'      => 'Sarip',
            'id_user'     => '0004',
            'email'     => 'sarip@gmail.com',
            'jabatan'   => 'Asisten Pertama AK3',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('sarip12345'),
        ]);

        $userAdmin = User::create([
            'nama'      => 'Maul',
            'id_user'     => '0005',
            'email'     => 'maul@gmail.com',
            'jabatan'   => 'Staff Admin',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('maul12345'),
        ]);

        $userAdmin2 = User::create([
            'nama'      => 'Heri',
            'id_user'     => '0006',
            'email'     => 'heri@gmail.com',
            'jabatan'   => 'Staff Admin',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('heri12345'),
        ]);

        $userPenyusunLHP = User::create([
            'nama'      => 'Intan',
            'id_user'     => '0007',
            'email'     => 'intan@gmail.com',
            'jabatan'   => 'Staff Penyusun LHP',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('intan12345'),
        ]);

        $userPenyusunLHP2 = User::create([
            'nama'      => 'Sarah',
            'id_user'     => '0008',
            'email'     => 'sarah@gmail.com',
            'jabatan'   => 'Staff Penyusun LHP',
            'avatar'    => 'images/default-avatar.png',
            'password'  => Hash::make('sarah12345'),
        ]);

        $userPetugas->assignRole($petugasRole);
        $userPetugas2->assignRole($petugasRole);
        $userPetugas3->assignRole($petugasRole);
        $userPetugas4->assignRole($petugasRole);
        $userAdmin->assignRole($adminRole);
        $userAdmin2->assignRole($adminRole);
        $userPenyusunLHP->assignRole($penyusunLHPRole);
        $userPenyusunLHP2->assignRole($penyusunLHPRole);

    }
}
