<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        $users = User::orderBy('last_name')->orderBy('first_name')->get();

        return view('auth.login', compact('users'));
    }

    public function login(Request $request)
    {

        $request->validate([
            'full_name' => ['required', 'string'],
            'password' => ['required'],
        ], [

            'password.required' => 'Le mot de passe est vide. Veuillez le remplir.',
        ]);


        $parts = explode(' ', trim($request->full_name), 2);

        $firstName = $parts[0] ?? '';
        $lastName = $parts[1] ?? '';


        $user = User::where('first_name', $firstName)
            ->where('last_name', $lastName)
            ->first();


        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'full_name' => 'Le mot de passe est incorrect.',
        ])->onlyInput('full_name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
