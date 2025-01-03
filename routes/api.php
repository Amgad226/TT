<?php

use App\Http\Controllers\ConvarsationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Route;

Route::get('testQuery/{id}',function($id){$user_id=1; return true;});

Route::post('login',[profileController::class,'login']);
Route::get('as',function(){
    return response()->json(['status'=>0,'message'=>'you shoud login'],401);
})->name('jsonResponse');


Route::middleware(["auth:sanctum"])->group(function(){
    Route::get('conversations'                               ,[ConvarsationController::class,'index']); //عرض محادثاتي
    Route::post('createGroup'                                ,[ConvarsationController::class,'createGroup']);
    Route::get('users_not_in_group/{id}/'                    ,[ConvarsationController::class,'users_not_in_group']);//invite
    Route::get('conversations/{id}/getParticipants'          ,[ConvarsationController::class,'getParticipants']);//
    Route::post('conversations/participants'                 ,[ConvarsationController::class,'addParticipants']);//add to group
    Route::delete('conversations/{conversation}/participants',[ConvarsationController::class,'removeParticipant']);//remove from group
    Route::post('search_chat'                                ,[ConvarsationController::class,'search_chat' ]);//don't use
    //----------------------------------------------------------------------------------------------------------------------------------------
    Route::get('conversations/{conversation}/messages'       ,[MessageController     ::class,'index']); 
    Route::post('messages'                                   ,[MessageController     ::class,'store'])->name('api.message.store');//store message
    Route::post('/sound'                                     ,[MessageController     ::class,'storeVoiceRecord']);
    Route::get('readMessage/{message}'                       ,[MessageController     ::class,'readMessage']); //read message if reciver person in chat
    Route::post('messages/{id}'                              ,[MessageController     ::class,'destroy']);
    //----------------------------------------------------------------------------------------------------------------------------------------
    Route::get('getUsers'                                    ,[profileController     ::class,'getUsers']);
    Route::post('search_users'                               ,[profileController     ::class,'search_users'])->name('search.users');
    Route::post('change_pass'                                ,[profileController     ::class,'change_pass'])->name('change_password');
    Route::post('updateImg'                                  ,[profileController     ::class,'updateImg'])->name('updateImg');
    Route::post('updateName'                                 ,[profileController     ::class,'updateName'])->name('updateName');
    Route::get('getNotification'                             ,[profileController     ::class,'getNotification']);//friends request from database
    Route::post('updateFirebaseToken'                        ,[profileController     ::class,'updateFirebaseToken']);
    Route::post('disableNoti'                                ,[profileController     ::class,'disableNoti']);
    //----------------------------------------------------------------------------------------------------------------------------------------
    Route::apiResource('friend'                              , FriendController      ::class);
    Route::post('search_friends'                             ,[FriendController      ::class,'search_friends'])->name('search.friends');
    //----------------------------------------------------------------------------------------------------------------------------------------
    Route::post('pusher/auth'                                ,[PusherController      ::class,'pusherAuth']);
    //----------------------------------------------------------------------------------------------------------------------------------------
    Route::post("cheakToken",function(){
        return auth()->user();
    });
});
