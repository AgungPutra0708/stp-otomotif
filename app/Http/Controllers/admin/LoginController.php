<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * Handle the login request.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah user ada di database
        $user = User::where('email', $request->email)->first();

        // Jika user ada dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Login user
            Auth::login($user);

            // Redirect berdasarkan status
            if ($user->status === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Welcome, Admin!');
            } else {
                return redirect()->route('home')->with('success', 'Welcome, User!');
            }
        }

        // Jika login gagal
        return redirect()->back()->with('error', 'Login failed!');
    }

    /**
     * Show the register form.
     */
    public function show()
    {
        return view('admin.register');
    }

    /**
     * Handle the register request.
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        // Simpan data user ke database dengan status 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'user', // Set status sebagai 'user'
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke home (karena status default adalah 'user')
        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
