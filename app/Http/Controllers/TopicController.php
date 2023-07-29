<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    //
    public function viewTopicPage()
    {

        $footer = "true";

        $navbar = "without-options";

        return view('topic', compact('navbar', 'footer'));
    }
}
