<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Tampilkan daftar user.
     */
    public function index()
    {
        // Kirim semua data users kecuali superAdmin
        $users = User::with('roles')->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'superAdmin');
            })->orderBy('created_at', 'desc')->get();

        return view('superadmin.index', [
            'title' => 'Kelola Pengguna',
            'subtitle' => 'Kelola role & hak akses pengguna',
            'users' => $users,
        ]);
    }

    /**
     * Update role user.
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:superAdmin,admin,petugas,penyusunLHP',
        ]);

        $user = User::findOrFail($id);

        // kalau pakai spatie/permission
        $user->syncRoles([$request->role]);

        // kalau pakai field 'role' di tabel users:
        // $user->role = $request->role;
        // $user->save();

        return redirect()->back()->with('success', "Role pengguna dengan nama \"{$user->nama}\" berhasil diperbarui!");
    }

    /**
     * Hapus user.
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // keamanan: jangan biarkan superAdmin menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->back()->with('success', "Pengguna dengan nama \"{$user->nama}\" berhasil dihapus!");
    }
}
