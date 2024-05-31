<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
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

        if (!$user instanceof User) {
            return redirect()->route('login');
        }

        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        return view('profile.index', compact('user', 'posts'));
        }

    public function seeProfiles(User $user)
    {
        $loggedInUserId = Auth::id();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        if ($user->id == $loggedInUserId) {
            return view('profile.index', compact('user', 'posts'));
        } else {
            return view('profiles.index', compact('user', 'posts'));
        }
    }
    
    public function verifyPassword(Request $request)
    {
        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Password salah!']);
        }
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($request->username != $user->username) {
            $validator->addRules(['username' => 'required|unique:users,username']);
        }

        if ($validator->fails()) {
            return redirect()->route('edit-profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user->username = $request->username;
        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('storage/profile', $fileName);

            $imagePath = public_path($user->profile_pic);
            if (file_exists($imagePath) && basename($imagePath) !== 'default_profile.png')
                unlink($imagePath);

            $user->profile_pic = '/storage/profile/' . $fileName;
        }
        
        $user->save();
            
        return redirect()->route('show-profile')
        ->with('success', 'Data User Berhasil diubah.');
    }
}