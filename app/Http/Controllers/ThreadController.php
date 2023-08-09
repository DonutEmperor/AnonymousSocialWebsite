<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;
use PDO;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\QueryException;


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
        try {
            $thread = new Thread();
            $thread->title = $req->input('title');
            $thread->content = $req->input('content');
            $thread->topic_id = $req->input('topic_id');

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
            // Unvote logic
            $thread->upvotes--; // Decrement upvotes
            $thread->save();

            Cookie::queue('vote_' . $thread->id, null); // Remove vote cookie
            Cookie::queue('active_' . $thread->id, null); // Remove active cookie
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
            // Unvote logic
            $thread->downvotes--; // Decrement upvotes
            $thread->save();

            Cookie::queue('vote_' . $thread->id, null); // Remove vote cookie
            Cookie::queue('active_' . $thread->id, null); // Remove active cookie
        }

        return response()->json([
            'upvotes' => $thread->upvotes,
            'downvotes' => $thread->downvotes,
        ]);
    }

    //Actually useless -> schedule to remove in the near future 
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

    public function createComment(Request $request)
    {
        // Validate the input
        $request->validate([
            'thread_id' => 'required|exists:threads,id', // Validate against your Thread model
            'comments' => 'required|string',
        ]);

        // Create a new comment
        $comment = new Comment();
        $comment->thread_id = $request->input('thread_id');
        $comment->body = $request->input('comments');
        // You might want to set other attributes here, such as user_id, upvotes, etc.

        $comment->save();

        // Redirect back or perform any other action
        return redirect()->route('thread', ['id' => $comment->thread_id])->with('success_comment', 'Comment created successfully.');

        // return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function commentUpvote(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $previousVote = Cookie::get('comment_vote_' . $comment->id);

        if (!$previousVote || $previousVote === 'downvote') {
            $comment->upvotes++;
            if ($previousVote === 'downvote') {
                $comment->downvotes--;
            }

            $comment->save();

            Cookie::queue('comment_vote_' . $comment->id, 'upvote');
            Cookie::queue('comment_active_' . $comment->id, 'upvote');
        } else {
            // Unvote logic here if the user clicks the same button
            $comment->upvotes--; // Decrement upvotes
            $comment->save();

            Cookie::queue('comment_vote_' . $comment->id, null); // Remove vote cookie
            Cookie::queue('comment_active_' . $comment->id, null); // Remove active cookie
        }

        return response()->json([
            'upvotes' => $comment->upvotes,
            'downvotes' => $comment->downvotes,
        ]);
    }

    public function commentDownvote(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $previousVote = Cookie::get('comment_vote_' . $comment->id);

        if (!$previousVote || $previousVote === 'upvote') {
            $comment->downvotes++;
            if ($previousVote === 'upvote') {
                $comment->upvotes--;
            }

            $comment->save();

            Cookie::queue('comment_vote_' . $comment->id, 'downvote');
            Cookie::queue('comment_active_' . $comment->id, 'downvote');
        } else {
            // Unvote logic here if the user clicks the same button
            $comment->downvotes--; // Decrement downvotes
            $comment->save();

            Cookie::queue('comment_vote_' . $comment->id, null); // Remove vote cookie
            Cookie::queue('comment_active_' . $comment->id, null); // Remove active cookie
        }

        return response()->json([
            'upvotes' => $comment->upvotes,
            'downvotes' => $comment->downvotes,
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
