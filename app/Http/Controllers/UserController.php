<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_pic' => 'assets/default_profile.png',
        ]);

        if ($user) {
            return redirect()->route('login')
                ->with('success', 'Akun Berhasil dibuat, silahkan login.');
        } else {
            return redirect()->route('register')
                ->with('error', 'Gagal membuat akun.');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return redirect()->route('login')
                ->with('error', 'Login gagal, username atau password salah!');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function showProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('profile.index', compact('user'));
    }
}