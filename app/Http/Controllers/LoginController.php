<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'defUsername' => 'required|string',
                'defPassword' => 'required|string',
            ]);

            $credentials = [
                'username' => $request->defUsername,
                'password' => $request->defPassword,
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();

                activity()
                    ->useLog('Auth')
                    ->withProperties(['ip' => $request->ip(), 'user_agent' => $request->userAgent()])
                    ->log('LOGIN');

                if ($user->hak === 'admin') {
                    return redirect()->intended('/admin');
                } elseif ($user->hak === 'kasir') {
                    return redirect()->intended('/kasir');
                } else {
                    return redirect()->intended('/manager');
                }
            }

            return redirect('/')->with('error', 'Username atau password salah');
        } catch (\Throwable $th) {
            return redirect('/')->with('error', 'Terjadi kesalahan, silakan coba lagi');
        }
    }

    public function logout(Request $request)
    {
        activity()
            ->useLog('Auth')
            ->withProperties(['ip' => $request->ip(), 'user_agent' => $request->userAgent()])
            ->log('LOGOUT');

        Auth::logout();

        return redirect('/')->with('success', 'Berhasil logout');
    }
}
