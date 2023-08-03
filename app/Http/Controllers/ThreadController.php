<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;

class ThreadController extends Controller
{
    //
    public function viewThreadPage($id)
    {

        $footer = "true";

        $navbar = "without-options";

        $allTopics = Topic::all();

        $threads = Thread::where('id', $id)->get();

        $comments = Comment::where('thread_id', $id)->orderBy('upvotes', 'desc')->get();
        $commentCount = $comments->count();

        // $threads = Thread::find($);

        return view('threadpage', compact('navbar', 'footer', 'threads', 'allTopics', 'comments', 'commentCount'));
    }
}
