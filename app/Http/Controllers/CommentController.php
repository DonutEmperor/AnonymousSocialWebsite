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

class CommentController extends Controller
{
    //
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
        $comment->creator_ip = encrypt($request->ip());
    
        $comment->save();

        // Redirect back or perform any other action
        return redirect()->route('thread', ['id' => $comment->thread_id])->with('success_comment', 'Comment created successfully.');

        // return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function updateComment(Request $req, $id)
    {
        $req->validate([
            'body' => 'required|string|max:255', // Max 50 characters
        ]);

        $comment = Comment::findOrFail($id);
        $comment->body = $req->input('body');
        $comment->save();

        return redirect()->route('thread', ['id' => $comment->thread_id])->with('success_comment', 'Comment updated successfully.');
    }


    public function deleteComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return redirect()->route('thread', ['id' => $comment->thread_id])->with('comment-delete-success', 'Comment deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['comment-deletion' => 'Error deleting comment.']);
        }
    }

    public function commentUpvote(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $previousVote = Session::get('comment_vote_' . $comment->id);

        if (!$previousVote || $previousVote === 'downvote') {
            $comment->upvotes++;
            if ($previousVote === 'downvote') {
                $comment->downvotes--;
            }

            $comment->save();

            Session::put('comment_vote_' . $comment->id, 'upvote');
            Session::put('comment_active_' . $comment->id, 'upvote');
        } else {
            // Unvote logic here if the user clicks the same button
            $comment->upvotes--; // Decrement upvotes
            $comment->save();

            Session::forget('comment_vote_' . $comment->id); // Remove vote session
            Session::forget('comment_active_' . $comment->id); // Remove active session
        }

        return response()->json([
            'upvotes' => $comment->upvotes,
            'downvotes' => $comment->downvotes,
        ]);
    }

    public function commentDownvote(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $previousVote = Session::get('comment_vote_' . $comment->id);

        if (!$previousVote || $previousVote === 'upvote') {
            $comment->downvotes++;
            if ($previousVote === 'upvote') {
                $comment->upvotes--;
            }

            $comment->save();

            Session::put('comment_vote_' . $comment->id, 'downvote');
            Session::put('comment_active_' . $comment->id, 'downvote');
        } else {
            // Unvote logic here if the user clicks the same button
            $comment->downvotes--; // Decrement downvotes
            $comment->save();

            Session::forget('comment_vote_' . $comment->id); // Remove vote session
            Session::forget('comment_active_' . $comment->id); // Remove active session
        }

        return response()->json([
            'upvotes' => $comment->upvotes,
            'downvotes' => $comment->downvotes,
        ]);
    }
}
