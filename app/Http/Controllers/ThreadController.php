<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;
use PDO;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;


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

        $previousVote = Cookie::get('vote_' . $thread->id);

        if (!$previousVote || $previousVote === 'downvote') {
            $thread->upvotes++;
            if ($previousVote === 'downvote') {
                $thread->downvotes--;
            }

            $thread->save();

            Cookie::queue('vote_' . $thread->id, 'upvote');
            Cookie::queue('active_' . $thread->id, 'upvote');
        } else {
            // Unvote logic here if the user clicks the same button
        }

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }

    public function downvote(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);

        $previousVote = Cookie::get('vote_' . $thread->id);

        if (!$previousVote || $previousVote === 'upvote') {
            $thread->downvotes++;
            if ($previousVote === 'upvote') {
                $thread->upvotes--;
            }

            $thread->save();

            Cookie::queue('vote_' . $thread->id, 'downvote');
            Cookie::queue('active_' . $thread->id, 'downvote');
        } else {
            // Unvote logic here if the user clicks the same button
        }

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }

    public function unvote(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);

        $previousVote = Cookie::get('vote_' . $id);

        if ($previousVote === 'upvote') {
            $thread->upvotes--;
        } elseif ($previousVote === 'downvote') {
            $thread->downvotes--;
        }

        $thread->save();

        Cookie::queue('vote_' . $id, null, -1); // Delete the cookie
        Cookie::queue('active_' . $id, null, -1); // Delete the cookie

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }

    // public function upvote(Request $request, $id)
    // {
    //     $thread = Thread::findOrFail($id);

    //     if (!Session::has('vote_' . $thread->id) || Session::get('vote_' . $thread->id) === 'downvote') {
    //         $thread->upvotes++;
    //         $thread->downvotes--;

    //         $thread->save();

    //         Session::put('vote_' . $thread->id, 'upvote');
    //     }


    //     return response()->json([
    //         'upvotes' => $thread->upvotes,
    //         'downvotes' => $thread->downvotes,
    //     ]);
    // }

    // public function downvote(Request $request, $id)
    // {
    //     $thread = Thread::findOrFail($id);
    //     if (!Session::has('vote_' . $thread->id) || Session::get('vote_' . $thread->id) === 'upvote') {
    //         $thread->upvotes--;
    //         $thread->downvotes++;

    //         $thread->save();

    //         Session::put('vote_' . $thread->id, 'downvote');
    //     }
    //     return response()->json([
    //         'upvotes' => $thread->upvotes,
    //         'downvotes' => $thread->downvotes,
    //     ]);
    // }

    // public function unvote(Request $request, $id)
    // {
    //     $thread = Thread::findOrFail($id);

    //     if (Session::has('vote_' . $id)) {
    //         $previousVote = Session::get('vote_' . $id);

    //         if ($previousVote === 'upvote') {
    //             $thread->upvotes--;
    //         } elseif ($previousVote === 'downvote') {
    //             $thread->downvotes--;
    //         }

    //         $thread->save();

    //         Session::forget('vote_' . $id);
    //     }

    //     return response()->json([
    //         'upvotes' => $thread->upvotes,
    //         'downvotes' => $thread->downvotes,
    //     ]);
    // }
}
