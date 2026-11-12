<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function landing()
    {
        return session('is_logged_in') ? redirect()->route('overview') : view('welcome');
    }

    public function showLogin()
    {
        return session('is_logged_in') ? redirect()->route('overview') : view('auth.login');
    }

    public function showRegister()
    {
        return session('is_logged_in') ? redirect()->route('overview') : view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique'       => 'Email ini sudah terdaftar.',
            'password.min'       => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $id = DB::table('users')->insertGetId([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $this->startSession($request, (object) ['id' => $id, 'name' => $data['name'], 'email' => $data['email']]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = DB::table('users')->where('email', $data['email'])->first();

        $ok = false;
        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                $ok = true;
            } elseif (hash_equals((string) $user->password, $data['password'])) {
                // Akun lama dengan password plaintext: terima sekali lalu upgrade jadi hash.
                $ok = true;
                DB::table('users')->where('id', $user->id)->update(['password' => Hash::make($data['password'])]);
            }
        }

        if (!$ok) {
            return back()->withInput($request->only('email'))->with('error', 'Email atau kata sandi salah.');
        }

        return $this->startSession($request, $user);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    private function startSession(Request $request, $user)
    {
        $request->session()->regenerate();
        session([
            'is_logged_in' => true,
            'user_id'      => $user->id,
            'user_name'    => $user->name,
            'user_email'   => $user->email,
        ]);
        return redirect()->route('overview');
    }
}
