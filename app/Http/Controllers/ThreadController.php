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

    public function createNewThread(Request $req)
    {
        $thread = new Thread();
        $thread->title = $req->input('title');
        $thread->content = $req->input('content');
        $thread->topic_id = $req->input('topic_id');

        $thread->save();

        return redirect()->route('topic', ['id' => $thread->topic_id])->with('success', 'Thread created successfully.');
    }

    public function voteClick(Request $req)
    {
        $threadId = $req->input('threadId');
        $action = $req->input('action');

        // Find the thread based on $threadId and increment/decrement the upvotes count
        // Save the changes to the database

        $thread = Thread::find($threadId);
        if ($action === 'up') {
            $thread->upvotes++;
        } elseif ($action === 'down') {
            $thread->downvotes++;
        }
        $thread->save();

        return response()->json(['upvotes' => $thread->upvotes]);
    }
}
