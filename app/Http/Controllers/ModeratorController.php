<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    //
    public function login()
    {
        return view('moderatorlogin');
    }

    public function logout()
    {
    }
}
