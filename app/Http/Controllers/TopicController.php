<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;
use Exception;

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

    public function createNewTopic(Request $req)
    {
        $req->validate([
            'title' => 'required|string|max:20|unique:topics', // Max 20 characters, unique in the topics table
            'description' => 'required|string',
        ]);

        $topic = new Topic();
        $topic->title = $req->input('title');
        $topic->description = $req->input('description');
        $topic->save();

        return redirect()->route('topic-list')->with('success_topic', 'Topic created successfully.');
    }

    public function updateTopic(Request $req, $id)
    {
        $req->validate([
            'title' => 'required|string|max:50|unique:topics,title,' . $id, // Max 20 characters, unique in the topics table, except for the current topic
            'description' => 'required|string',
        ]);

        $topic = Topic::findOrFail($id);
        $topic->title = $req->input('title');
        $topic->description = $req->input('description');
        $topic->save();

        return redirect()->route('topic', ['id' => $id])->with('success_topic', 'Topic updated successfully.');
    }

    public function deleteTopic($id)
    {
        try {
            $topic = Topic::findOrFail($id);
            $topic->delete();

            return redirect()->route('topic-list')->with('topic-delete-success', 'Topic deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['topic-deletion' => 'Error deleting topic.']);
        }
    }
}
