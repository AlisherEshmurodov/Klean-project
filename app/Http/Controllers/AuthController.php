<?php

namespace App\Http\Controllers;

use App\Mail\UserLogined;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_store(Request $request)
    {

        $validated = $request->validate([
                'email' => 'required|email:rfc,dns|unique:users,email',
                'name' => 'required',   /*  |unique:users,username  */
                'password' => 'required|min:3',
                'password_confirmation' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->roles()->attach(3);

        auth()->login($user);

        return redirect('/')->with('success', "Account successfully registered.");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
//            Mail::to($request->user())->send(new UserLogined($user));
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function logout(Request $request) /*: RedirectResponse*/
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



}

