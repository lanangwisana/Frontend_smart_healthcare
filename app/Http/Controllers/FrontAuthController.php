<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FrontAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $response = Http::post('http://localhost:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->status() === 200) {
            $user = $response->json()['user'];
            session(['user' => $user]);
            return redirect('/dashboard');
        }

        return back()->with('message', $response->json()['message'] ?? 'Login gagal');
    }

     public function register(Request $request)
    {
        $response = Http::post('http://localhost:8000/api/register', [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'nik' => $request->nik,
            'nama_pasien' => $request->nama_pasien,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
            'nama_admin' => $request->nama_admin,
        ]);

        if ($response->status() === 201) {
            return redirect('/login')->with('message', 'Registrasi berhasil');
        }

        return back()->with('message', $response->json()['message'] ?? 'Registrasi gagal');
    }
}
