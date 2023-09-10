<?php

namespace App\Http\Controllers;

use App\Models\BlockedIp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Exception;

class ModeratorController extends Controller
{
    //
    public function showLogin()
    {
        return view('moderatorlogin');
    }

    public function login(Request $req)
    {
        $credentials = $req->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            // return redirect()->intended('/modPage'); // Redirect to intended page after login
            return redirect()->route('mod')->with('login-success', 'Logged In Successfully');
        } else {
            // Authentication failed
            return redirect()->route('login')->withErrors(['message' => 'Invalid username or password']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('logout-success', 'Logged Out Successfully');
    }

    //temporary
    public function createSingleUser()
    {
        $user = new User([
            'username' => 'donutmaster',
            'email' => 'mod@chadpalace.support',
            'password' => Hash::make('strongpassword'),
        ]);

        $user->save();
    }

    public function viewModPage()
    {
        $footer = "true";
        $navbar = "mod-navbar";

        $allTopics = Topic::orderBy('id', 'asc')->get();

        $allThreads = Thread::orderBy('downvotes', 'desc')->get();

        $allComments = Comment::orderBy('downvotes', 'desc')->get();

        return view('moderatorpage', compact('footer', 'navbar', 'allTopics', 'allThreads', 'allComments'));
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

        return redirect()->route('mod')->with('success_topic', 'Topic updated successfully.');
    }

    public function deleteTopic($id)
    {
        try {
            $topic = Topic::findOrFail($id);
            $topic->delete();

            return redirect()->route('mod')->with('topic-delete-success', 'Topic deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['topic-deletion' => 'Error deleting topic.']);
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

        return redirect()->route('mod')->with('success_thread', 'Thread updated successfully.');
    }

    public function deleteThread($id)
    {
        try {
            $thread = Thread::findOrFail($id);
            $thread->delete();

            return redirect()->route('mod')->with('thread-delete-success', 'Thread deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['thread-deletion' => 'Error deleting thread.']);
        }
    }

    public function banThread($id)
    {
        try {
            $thread = Thread::findOrFail($id);
            $ban_table = new BlockedIp();
            $ban_table->ip = $thread->creator_ip;

            $ban_table->save();
            $thread->delete();

            return redirect()->route('mod')->with('thread-ban-success', 'Thread banned successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['thread-ban' => 'Error banning thread.']);
        }
    }

    public function updateComment(Request $req, $id)
    {
        $req->validate([
            'body' => 'required|string|max:255', // Max 50 characters
        ]);

        $comment = Comment::findOrFail($id);
        $comment->body = $req->input('body');
        $comment->save();

        return redirect()->route('mod')->with('success_comment', 'Comment updated successfully.');
    }


    public function deleteComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return redirect()->route('mod')->with('comment-delete-success', 'Comment deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['comment-deletion' => 'Error deleting comment.']);
        }
    }

    public function banComment($id)
    {
        try {
            $comment = Comment::findOrFail($id);
            $ban_table = new BlockedIp();
            $ban_table->ip = $comment->creator_ip;
            
            $ban_table->save();
            $comment->delete();

            return redirect()->route('mod')->with('comment-delete-success', 'Comment deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['comment-deletion' => 'Error deleting comment.']);
        }
    }

}
