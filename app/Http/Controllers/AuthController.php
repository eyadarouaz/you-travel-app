<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    // View Rendering
    public function signin()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.register');
    }

    // Business Logic
    public function register(Request $request)
    {
        try {

            $validated = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ]);

            if ($validated) {
                $user = new User();
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role = 'user';
                $user->save();
            }

            Auth::login($user);
            return redirect()->route('trip.index');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->intended(route('user.index'));
            } else {
                return redirect()->intended(route('trip.index'));
            }
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.signin');
    }
}

