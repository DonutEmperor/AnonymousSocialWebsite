<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Hash;

class ThreadController extends Controller
{
    //
    public function viewThreadPage($id)
    {

        $footer = "true";

        if (auth()->check()) {
            $navbar = "mod-navbar"; // User is logged in
        } else {
            $navbar = "without-options"; // User is not logged in
        }

        $allTopics = Topic::all();

        $threads = Thread::where('id', $id)->get();

        $comments = Comment::where('thread_id', $id)->orderBy('upvotes', 'desc')->get();
        $commentCount = $comments->count();

        if ($threads->isEmpty()) {
            return redirect()->route('not-found'); // Show a 404 error page
        }
        // $threads = Thread::find($);

        return view('threadpage', compact('navbar', 'footer', 'threads', 'allTopics', 'comments', 'commentCount'));
    }

    public function createNewThread(Request $req)
    {
        try {
            $thread = new Thread();
            $thread->title = $req->input('title');
            $thread->content = $req->input('content');
            $thread->topic_id = $req->input('topic_id');
            $userIP = $req->ip();
            $thread-> creator_ip = $userIP;

            $thread->save();

            return redirect()->route('topic', ['id' => $thread->topic_id])->with('success_thread', 'Thread created successfully.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                // Unique constraint violation (duplicate title)
                return redirect()->back()->withErrors(['title' => 'A thread with this title already exists.']);
            }

            // Handle other query exceptions if needed
        }
    }

    public function updateThread(Request $req, $id)
    {
        $req->validate([
            'title' => 'required|string|max:50|unique:threads,title,' . $id, // Max 20 characters, unique in the threads table, except for the current thread
            'content' => 'required|string',
        ]);

        $thread = Thread::findOrFail($id);
        $thread->title = $req->input('title');
        $thread->content = $req->input('content');
        $thread->save();

        return redirect()->route('thread', ['id' => $id])->with('success_thread', 'Thread updated successfully.');
    }

    public function deleteThread($id)
    {
        try {
            $thread = Thread::findOrFail($id);
            $thread->delete();

            return redirect()->route('topic', ['id' => $thread->topic_id])->with('thread-delete-success', 'Thread deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['thread-deletion' => 'Error deleting thread.']);
        }
    }

    public function upvote(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);

        $previousVote = session('vote_' . $thread->id);

        if (!$previousVote || $previousVote === 'downvote') {
            $thread->upvotes++;
            if ($previousVote === 'downvote') {
                $thread->downvotes--;
            }

            $thread->save();

            session(['vote_' . $thread->id => 'upvote']);
            session(['active_' . $thread->id => 'upvote']);
        } else {
            // Unvote logic here if the user clicks the same button
            $thread->upvotes--; // Decrement upvotes
            $thread->save();

            session()->forget('vote_' . $thread->id); // Remove vote session data
            session()->forget('active_' . $thread->id); // Remove active session data
        }

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }

    public function downvote(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);

        $previousVote = session('vote_' . $thread->id);

        if (!$previousVote || $previousVote === 'upvote') {
            $thread->downvotes++;
            if ($previousVote === 'upvote') {
                $thread->upvotes--;
            }

            $thread->save();

            session(['vote_' . $thread->id => 'downvote']);
            session(['active_' . $thread->id => 'downvote']);
        } else {
            // Unvote logic here if the user clicks the same button
            $thread->downvotes--; // Decrement downvotes
            $thread->save();

            session()->forget('vote_' . $thread->id); // Remove vote session data
            session()->forget('active_' . $thread->id); // Remove active session data
        }

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }


    //Actually useless -> schedule to remove in the near future 
    // public function unvote(Request $request, $id)
    // {
    //     $thread = Thread::findOrFail($id);

    //     $previousVote = Cookie::get('vote_' . $id);

    //     if ($previousVote === 'upvote') {
    //         $thread->upvotes--;
    //     } elseif ($previousVote === 'downvote') {
    //         $thread->downvotes--;
    //     }

    //     $thread->save();

    //     Cookie::queue('vote_' . $id, null, -1); // Delete the cookie
    //     Cookie::queue('active_' . $id, null, -1); // Delete the cookie

    //     return response()->json([
    //         'upvotes' => $thread->upvotes,
    //         'downvotes' => $thread->downvotes,
    //     ]);
    // }



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
