<?php

namespace App\Http\Controllers;

use App\View\Components\navbar;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;

class HomeController extends Controller
{
    //
    public function viewHomePage()
    {
        $footer = "true";

        $navbar = "without-options";

        $allTopics = Topic::all();

        // $threadsPerPage = 3; // Number of threads per page
        // $allThreads = Thread::orderByDesc('upvotes')->paginate($threadsPerPage);

        $allThreads = Thread::orderByDesc('upvotes')->get();

        return view('homepage', compact('navbar', 'footer', 'allTopics', 'allThreads'));
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
