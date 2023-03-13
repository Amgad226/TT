<?php

use App\Events\MessageCreated;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\PusherController;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;



// Auth::routes(['register' => false]);

// Route::get('/a/{id?}',[MessengerController::class,'index'])->middleware('auth')->name('messenger');


// Auth::routes(['except' => ['password.request', 'verification.notice', 'verification.verify']]);
// Auth::routes(['register' => true, 'reset' => false, 'verify' => false, 'confirm' => false, 'except' => ['password.request', 'verification.notice', 'verification.verify']]);
// Auth::routes(['reset' => false, 'verify' => false, 'confirm' => false]);
Auth::routes(['register' => true, 'reset' => false, 'verify' => false, 'confirm' => false]);


// Route::get('as',function(){
//     return response()->json(['status'=>0,'message'=>'you shoud login']);
// })->name('jsonResponse');


Route::view('/','messenger')->name('tt')->middleware('auth:sanctum');
// Route::view('/a','welcome')->name('tt')->middleware('auth:sanctum');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::view('/404','404')->name('404');
