<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;

class ThreadController extends Controller
{
    //
    public function viewThreadPage($id)
    {

        $footer = "true";

        $navbar = "without-options";

        $allTopics = Topic::all();

        $threads = Thread::where('id', $id);

        return view('threadpage', compact('navbar', 'footer', 'allTopics', 'threads'));
    }
}
