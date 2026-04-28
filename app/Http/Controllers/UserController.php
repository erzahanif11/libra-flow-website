<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $action = $request->input('action');

        if ($action === 'update_username') {
            $request->validate([
                'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            ]);

            $user->update(['username' => $request->username]);

            return back()->with('success', 'Username updated successfully.');
        }

        if ($action === 'update_email') {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);

            $user->update(['email' => $request->email]);

            return back()->with('success', 'Email updated successfully.');
        }

        if ($action === 'update_password') {
            $request->validate([
                'password_old' => 'required|string',
                'password_new' => 'required|string|min:8|confirmed',
            ]);

            if (! Auth::validate(['username' => $user->username, 'password' => $request->password_old])) {
                return back()->withErrors(['password_old' => 'Old password is incorrect.']);
            }

            $user->update(['password' => bcrypt($request->password_new)]);

            return back()->with('success', 'Password updated successfully.');
        }

        return back();
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect()->route('register')->with('success', 'Account deleted successfully.');
    }
}
