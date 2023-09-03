<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockingController;
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

//Landing Page Routes
Route::get('/', [LandingController::class, 'viewDisclaimerPage'])->name('disclaimer');

//Basic Pages Routes
Route::get('/home', [HomeController::class, 'viewHomePage'])->name('home');
Route::get('/about', [HomeController::class, 'viewAboutUs'])->name('about');
Route::get('/privacypolicy', [HomeController::class, 'viewPolicyPage'])->name('policy');
Route::get('/notFound', [HomeController::class, 'viewErrorPage'])->name('not-found');

//Topic Related Routes
Route::get('/topiclist', [TopicController::class, 'viewTopicList'])->name('topic-list');
Route::get('/topic/{id}', [TopicController::class, 'viewTopicPage'])->name('topic');
Route::post('/topic/create', [TopicController::class, 'createNewTopic'])->name('topic.create');
Route::put('/topic/{id}/update', [TopicController::class, 'updateTopic'])->name('topic.update');
Route::delete('/topic/{id}/delete', [TopicController::class, 'deleteTopic'])->name('topic.delete');

//Thread Related Routes
Route::get('/thread/{id}', [ThreadController::class, 'viewThreadPage'])->name('thread');
Route::put('/thread/{id}/update', [ThreadController::class, 'updateThread'])->name('thread.update');
Route::delete('/thread/{id}/delete', [ThreadController::class, 'deleteThread'])->name('thread.delete');
//Thread Vote Routes
Route::post('/thread/{id}/upvote', [ThreadController::class, 'upvote'])->name('thread.upvote');
Route::post('/thread/{id}/downvote', [ThreadController::class, 'downvote'])->name('thread.downvote');

// Rate Handling Middleware (Currently still applies to moderator)
Route::middleware('rate_limit:2,1')->group(function () {
    Route::post('/createComment', [CommentController::class, 'createComment'])->name('comment.create');
    Route::post('/thread', [ThreadController::class, 'createNewThread'])->name('thread.create');
});

//Comment Related Routes
Route::put('/comment/{id}/update', [CommentController::class, 'updateComment'])->name('comment.update');
Route::delete('/comment/{id}/delete', [CommentController::class, 'deleteComment'])->name('comment.delete');
//Commment Vote Routes
Route::post('/comment/{id}/upvote', [CommentController::class, 'commentUpvote'])->name('comment.upvote');
Route::post('/comment/{id}/downvote', [CommentController::class, 'commentDownvote'])->name('comment.downvote');

//Moderator Related Routes
Route::get('/login', [ModeratorController::class, 'showLogin'])->name('login');
Route::post('/login', [ModeratorController::class, 'login']);
Route::get('/logout', [ModeratorController::class, 'logout'])->name('logout');

//ONE TIME USE - GENERATE NEW MODERATOR Route
Route::get('/generateMod', [ModeratorController::class, 'createSingleUser'])->name('user.generate');

//Moderator Middleware
Route::middleware('moderator')->group(function () {
    Route::get('/modPage', [ModeratorController::class, 'viewModPage'])->name('mod');
    Route::put('/mod/topic/{id}/update', [ModeratorController::class, 'updateTopic'])->name('mod-topic.update');
    Route::delete('/mod/topic/{id}/delete', [ModeratorController::class, 'deleteTopic'])->name('mod-topic.delete');
    Route::put('/mod/thread/{id}/update', [ModeratorController::class, 'updateThread'])->name('mod-thread.update');
    Route::delete('/mod/thread/{id}/delete', [ModeratorController::class, 'deleteThread'])->name('mod-thread.delete');
    Route::put('/mod/comment/{id}/update', [ModeratorController::class, 'updateComment'])->name('mod-comment.update');
    Route::delete('/mod/comment/{id}/delete', [ModeratorController::class, 'deleteComment'])->name('mod-comment.delete');
});

//Blocked Page Route
Route::get('/blocked', [BlockingController::class, 'viewBlockedPage'])->name('blocked');
