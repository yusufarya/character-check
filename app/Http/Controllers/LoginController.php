<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login'); // Show the login form
    }

    public function loginProcess(Request $request)
    {
        $validatedData = $request->validate([
            'email'  => 'required|email',
            'password'  => 'required'
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email salah.',
            'password.required' => 'Password Harus diisi.',
        ]);
        // dd($validatedData);
        $resultUser = User::where('email', $validatedData['email'])->count();

        if(!$resultUser) {
            session()->flash('failed', 'Akun tidak terdaftar.');
            return redirect('/login');
        }
        // dd(auth('web'));
        if (auth('web')->attempt($validatedData)) {

            $isActive = Auth::guard('web')->user()->is_active == "Y";
            if ($isActive == true) {
                return redirect()->intended('/');
            } else {
                Auth::guard('web')->logout();
                session()->flash('failed', 'Akun tidak aktif, Hubungi Administrator.');
                return redirect('/login');
            }
        }

        return back()->with('failed', 'Username atau Password salah!');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login'); // Redirect to home after logout
    }
}
