<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockingController extends Controller
{
    //
    public function viewBlockedPage()
    {
        $footer = "false";

        $navbar = "";

        return view('blocked-Page', compact('footer', 'navbar'));
    }
}
