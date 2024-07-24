<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('movie');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function setting()
    {
        return view('auth.setting', [
            'user' => Auth::user()
        ]); // Menyertakan data pengguna saat ini
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed|min:8',
        ]);

        // Update data pengguna
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Cek dan update password jika diberikan
        if (!empty($validated['current_password']) && Hash::check($validated['current_password'], $user->password)) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()->route('setting')->with('status', 'Profile updated successfully!');
    }
}
