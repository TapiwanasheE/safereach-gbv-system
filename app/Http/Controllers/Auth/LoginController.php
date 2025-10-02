<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\session;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
//        dd($user->role->name);
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Redirect based on user role
            switch ($user->role->name) {
                case 'Super User':
                    return redirect('/super-user/dashboard');
                case 'Medical':
                    return redirect('/medical/dashboard');
                case 'Counselor':
                    return redirect('/counselor/dashboard');
                case 'Law Enforcement':
                    return redirect('/law-enforcement/dashboard');
                default:
                    return redirect('/victim/dashboard');
            }
        } else {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }
}
