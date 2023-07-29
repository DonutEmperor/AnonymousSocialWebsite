<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThreadController extends Controller
{
    //
    public function viewThreadPage()
    {

        $footer = "true";

        $navbar = "without-options";

        return view('threadpage', compact('navbar', 'footer'));
    }
}
