<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ModeratorController extends Controller
{
    //
    public function showLogin()
    {
        return view('moderatorlogin');
    }

    public function login(Request $req)
    {
        $credentials = $req->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            // return redirect()->intended('/modPage'); // Redirect to intended page after login
            return redirect()->route('mod')->with('login-success', 'Logged In Successfully');
        } else {
            // Authentication failed
            return redirect()->route('login')->withErrors(['message' => 'Invalid username or password']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('logout-success', 'Logged Out Successfully');
    }

    //temporary
    public function createSingleUser()
    {
        $user = new User([
            'username' => 'donutmaster',
            'email' => 'mod@chadpalace.support',
            'password' => Hash::make('strongpassword'),
        ]);

        $user->save();
    }

    public function viewModPage()
    {
        $footer = "true";
        $navbar = "mod-navbar";
        return view('moderatorpage', compact('footer', 'navbar'));
    }
}
