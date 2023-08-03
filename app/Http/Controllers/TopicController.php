<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Topic;
use App\Models\Thread;

class TopicController extends Controller
{
    //
    public function viewTopicPage($id)
    {

        $footer = "true";

        $navbar = "without-options";

        $topics = Topic::where('id', $id)->get();

        $allTopics = Topic::all();

        return view('topic', compact('navbar', 'footer', 'topics', 'allTopics'));
    }

    public function viewTopicList()
    {

        $footer = "true";

        $navbar = "without-options";

        $topics = Topic::orderBy('title', 'asc')->get();

        return view('topic-list', compact('navbar', 'footer', 'topics'));
    }
}
