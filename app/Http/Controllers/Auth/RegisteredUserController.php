<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Proses simpan data user baru
     */
    public function store(Request $request)
    {
        // 🔎 Validasi input
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[A-Za-z0-9._%+-]+@pkuwsb\.id$/'
            ],
            'password' => [
                'required',
                'string',
                'min:7',
                'regex:/[0-9]/',   // harus ada angka
                'regex:/[A-Z]/',   // harus ada huruf kapital
                'regex:/[a-z]/',   // harus ada huruf kecil
                'confirmed',
            ],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // 📂 Simpan foto profil kalau ada
        $profilePath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // 👤 Buat user baru
        $user = User::create([
            'name' => $request->full_name,  // default "name"
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo' => $profilePath,
        ]);

        // Event Laravel (opsional, untuk email verifikasi)
        event(new Registered($user));

        // Auto login setelah register
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');
    }
}
