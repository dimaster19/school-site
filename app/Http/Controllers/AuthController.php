<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
    public function login($error = false)
    {
        $title = 'Вход в аккаунт';
        return view('login', compact('title', 'error'));
    }

    public function logout(Request $request )
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // check checkbox
        $remember = $request->remember;
        if ( $remember == "on") {
            $remember = true;
        }
        else {
            $remember = false;
        }
        // ----
        Log::debug('remember_token = '. $remember);
        if (Auth::attempt($credentials,  $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('admin-panel');
        }

        return back()->withErrors([
            'auth' => 'Аккаунт с такими учетные данными не существует',
        ]);
    }

}
