<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

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
Route::get('/notFound', [HomeController::class, 'viewErrorPage']);

Route::get('/topiclist', [TopicController::class, 'viewTopicList'])->name('topic-list');
Route::get('/topic/{id}', [TopicController::class, 'viewTopicPage'])->name('topic');


Route::get('/thread', [ThreadController::class, 'viewThreadPage'])->name('thread');
