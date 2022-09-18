<?php

use App\Events\MessageCreated;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('as',function(){return 12;});
Route::get('as',function(){return 12;})->name('aaa');

Route::get('/a/{id?}',[MessengerController::class,'index'])->middleware('auth')->name('messenger');


Route::get('/', function () {
    // redirect('messenger');
  return  redirect()->route('messenger');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home',function(){return 12;});
// Route::post('/broadcasting/auth', [PusherController::class, 'pusherAuth'])
// ->middleware('auth');
// Route::post('search_chat'    ,[MessageController::class,'search_chat'])->middleware('auth')->name('search.chat');
