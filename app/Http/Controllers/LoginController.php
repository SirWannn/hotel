<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Jika Admin
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            // Jika Manajer
            if (Auth::user()->role === 'manajer') {
                return redirect('/manajer');
            }

            // Jika Tamu
            if (Auth::user()->role === 'tamu') {

                $kamarId = session('kamar_id');

                if ($kamarId) {

                    session()->forget('kamar_id');

                    return redirect(
                        '/reservasi?kamar_id=' . $kamarId
                    );
                }

                return redirect('/');
            }
        }

        return back()
            ->withInput()
            ->with(
                'error',
                'Username atau password salah.'
            );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}