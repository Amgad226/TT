<?php

use App\Events\MessageCreated;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\PusherController;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

// Auth::routes(['register' => false]);

Route::get('as',function(){
    // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    // Message::truncate();
    // DB::statement('SET FOREIGN_KEY_CHECKS=1;');


    return response('you shoud login');})->name('loginn');

Route::get('/a/{id?}',[MessengerController::class,'index'])->middleware('auth')->name('messenger');

Route::view('/','messenger')->middleware('auth');
// Route::view('aa','messenger_copy');
// Route::view('we','welcome');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::post('/broadcasting/auth', [PusherController::class, 'pusherAuth'])