<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function viewDisclaimerPage()
    {
        $footer = "false";

        $navbar = "";

        return view('disclaimerpage', compact('footer', 'navbar'));
    }
}
