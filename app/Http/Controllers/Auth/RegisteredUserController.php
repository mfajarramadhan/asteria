<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'id_user' => ['required', 'string', 'max:50', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'jabatan' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Proses upload file foto
        if($request->hasFile('avatar')){
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            // tambahkan validated avatar nanti
        }else{
            $avatarPath = 'avatars/default.png';
        }

        $user = User::create([
            'nama' => $request->nama,
            'id_user' => $request->id_user, 
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'avatar' => $avatarPath,
            'password' => Hash::make($request->password),
        ]);

        // default role = Penyusun LHP
        $user->assignRole('Penyusun LHP');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
