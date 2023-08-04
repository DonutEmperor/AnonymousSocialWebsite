<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;
use PDO;

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

    public function upvote(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);
        $thread->upvotes++;
        $thread->save();

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }

    public function downvote(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);
        $thread->downvotes++;
        $thread->save();

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }

    // public function upvote(Request $req, $id)
    // {
    //     $thread = Thread::findOrFail($id);

    //     // Increment the upvotes count
    //     $thread->upvotes++;

    //     // Save the updated thread
    //     $thread->save();

    //     return redirect()->back();
    // }

    // public function downvote(Request $req, $id)
    // {
    //     $thread = Thread::findOrFail($id);

    //     // Increment the downvotes count
    //     $thread->downvotes++;

    //     // Save the updated thread
    //     $thread->save();

    //     return redirect()->back();
    // }
}
