<?php

namespace App\Http\Controllers;

use App\View\Components\navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Thread;

class HomeController extends Controller
{
    //
    public function viewHomePage()
    {
        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        $allTopics = Topic::all();

        // $threadsPerPage = 3; // Number of threads per page
        // $allThreads = Thread::orderByDesc('upvotes')->paginate($threadsPerPage);

        $allThreads = Thread::orderByDesc('upvotes')->get();

        return view('homepage', compact('navbar', 'footer', 'allTopics', 'allThreads'));
    }

    public function viewAboutUs()
    {
        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        return view('aboutus', compact('navbar', 'footer'));
    }

    public function viewPolicyPage()
    {
        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        return view('privacypolicy', compact('navbar', 'footer'));
    }

    public function viewErrorPage()
    {
        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        return view('error404', compact('navbar', 'footer'));
    }

    public function viewNews(){
        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        return view('news', compact('navbar', 'footer'));
    }
}
