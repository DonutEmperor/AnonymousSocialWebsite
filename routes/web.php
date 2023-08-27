<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Http\Exceptions\NotFound;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingController::class, 'viewDisclaimerPage'])->name('disclaimer');

Route::get('/home', [HomeController::class, 'viewHomePage'])->name('home');
Route::get('/about', [HomeController::class, 'viewAboutUs'])->name('about');
Route::get('/privacypolicy', [HomeController::class, 'viewPolicyPage'])->name('policy');
Route::get('/notFound', [HomeController::class, 'viewErrorPage'])->name('not-found');

Route::get('/topiclist', [TopicController::class, 'viewTopicList'])->name('topic-list');
Route::get('/topic/{id}', [TopicController::class, 'viewTopicPage'])->name('topic');
Route::post('/topic/create', [TopicController::class, 'createNewTopic'])->name('topic.create');
Route::put('/topic/{id}/update', [TopicController::class, 'updateTopic'])->name('topic.update');
Route::delete('/topic/{id}/delete', [TopicController::class, 'deleteTopic'])->name('topic.delete');


Route::get('/thread/{id}', [ThreadController::class, 'viewThreadPage'])->name('thread');
Route::post('/thread', [ThreadController::class, 'createNewThread'])->name('thread.create');
Route::put('/thread/{id}/update', [ThreadController::class, 'updateThread'])->name('thread.update');
Route::delete('/thread/{id}/delete', [ThreadController::class, 'deleteThread'])->name('thread.delete');

Route::post('/thread/{id}/upvote', [ThreadController::class, 'upvote'])->name('thread.upvote');
Route::post('/thread/{id}/downvote', [ThreadController::class, 'downvote'])->name('thread.downvote');
Route::post('/thread/{id}/unvote', [ThreadController::class, 'unvote'])->name('thread.unvote');

Route::post('/createComment', [CommentController::class, 'createComment'])->name('comment.create');
Route::put('/comment/{id}/update', [CommentController::class, 'updateComment'])->name('comment.update');
Route::delete('/comment/{id}/delete', [CommentController::class, 'deleteComment'])->name('comment.delete');

Route::post('/comment/{id}/upvote', [CommentController::class, 'commentUpvote'])->name('comment.upvote');
Route::post('/comment/{id}/downvote', [CommentController::class, 'commentDownvote'])->name('comment.downvote');

Route::get('/login', [ModeratorController::class, 'showLogin'])->name('login');
Route::post('/login', [ModeratorController::class, 'login']);
Route::get('/logout', [ModeratorController::class, 'logout'])->name('logout');

Route::get('/generateMod', [ModeratorController::class, 'createSingleUser'])->name('user.generate');

Route::middleware('moderator')->group(function () {
    Route::get('/modPage', [ModeratorController::class, 'viewModPage'])->name('mod');
});
