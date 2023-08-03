<?php

namespace App\Http\Controllers;

use App\View\Components\navbar;
use Illuminate\Http\Request;
use App\Models\Topic;

class HomeController extends Controller
{
    //
    public function viewHomePage()
    {
        $footer = "true";

        $navbar = "without-options";

        $allTopics = Topic::all();

        return view('homepage', compact('navbar', 'footer', 'allTopics'));
    }

    public function viewAboutUs()
    {
        $footer = "true";

        $navbar = "without-options";

        return view('aboutus', compact('navbar', 'footer'));
    }

    public function viewPolicyPage()
    {
        $footer = "true";

        $navbar = "without-options";

        return view('privacypolicy', compact('navbar', 'footer'));
    }

    public function viewErrorPage()
    {
        $footer = "true";

        $navbar = "without-options";

        return view('error404', compact('navbar', 'footer'));
    }
}
