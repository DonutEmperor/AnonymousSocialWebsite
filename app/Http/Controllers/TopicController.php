<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;

class TopicController extends Controller
{
    //
    public function viewTopicPage($id)
    {

        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        $topics = Topic::where('id', $id)->get();

        $allTopics = Topic::all();

        $allThreads = Thread::where('topic_id', $id)->orderBy('upvotes', 'desc')->get();

        $threadID = Thread::where('topic_id', $id)->pluck('id');

        if ($topics->isEmpty()) {
            return redirect()->route('not-found'); // Show a 404 error page
        } else {
            return view('topic', compact('navbar', 'footer', 'topics', 'allTopics', 'allThreads'));
        }
    }

    public function viewTopicList()
    {

        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        $topics = Topic::orderBy('title', 'asc')->get();

        return view('topic-list', compact('navbar', 'footer', 'topics'));
    }
}
