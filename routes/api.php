<?php

// use App\Models\Conversation;

use App\Http\Controllers\ConvarsationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PusherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Broadcast::routes();

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[MessageController::class,'login']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return '11111111111111111';
//  })->name('api.message.store');
// Route::get('conversations',function(){dd(1);});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('conversations',[ConvarsationController::class,'index']);
    
    Route::get('conversations/{id}',[ConvarsationController::class,'show']);
    Route::get('getUsers',[ConvarsationController::class,'getUsers']);
    Route::post('conversations/{conversation}/participants',[ConvarsationController::class,'addParticipant']);
    Route::delete('conversations/{conversation}/participants',[ConvarsationController::class,'removeParticipant']);
    
    // MessengerController
    Route::post('messages'    ,[MessageController::class,'store'])->name('api.message.store');
    Route::get('conversations/{id}/messages',[MessageController::class,'index']);
    Route::get('messages/{id}',[MessageController::class,'destroy']);
    Route::post('search_chat'    ,[MessageController::class,'search_chat'])->name('search.chat');
    Route::post('search_users'    ,[MessageController::class,'search_users'])->name('search.users');
    Route::get('logout'    ,[MessageController::class,'logout'])->name('logoudt');
    Route::post('change_pass'    ,[MessageController::class,'change_pass'])->name('change_password');
    Route::post('pusher/auth'    ,[PusherController::class,'pusherAuth']);

    // Route::get('getfriends', [ FriendController::class,'getfriends']);
    Route::get('getNotification'    ,[NotificationController::class,'getNotification']);
    

    // Route::apiResource('friend',  FriendController::class);

    Route::get('getFriend'    ,[FriendController::class,'index']);
    Route::post('addFriend'    ,[FriendController::class,'store']);
    Route::post('acceptFriend/{frindship_id}'    ,[FriendController::class,'update']);
    Route::post('refusFriend/{frindship_id}'    ,[FriendController::class,'destroy']);
    
    
});
