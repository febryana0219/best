<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\AdministratorModel;

class AdminAuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.homepage.slide_show.index');
        }

        $activeMenu = 'login';
        return view('admin.login', compact('activeMenu'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::user();

            if ($user->active !== 1) {
                Auth::guard('web')->logout();
                return back()->withErrors([
                    'email' => 'Your account is inactive.',
                ])->withInput();
            }

            $request->session()->regenerate();

            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ]);

            AdministratorModel::where('id', $user->id)->update(['last_login' => now()]);

            return redirect()->route('admin.homepage.slide_show.index')
                             ->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flush();

        return redirect()->route('admin.login');
    }
}
