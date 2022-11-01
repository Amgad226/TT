<?php

// use App\Models\Conversation;

use App\Http\Controllers\ConvarsationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\PusherController;
use App\Models\Conversation;
use App\Models\Participant;
use App\Models\User;
use Egulias\EmailValidator\Parser\PartParser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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


Route::get('test',function(){

dd(config('app.envTyping'));
 
     
    // try {
    //     $decrypted = Crypt::decryptString('eyJpdiI6IjA2d2xObWp1bjJiMXdGM0FoTDRNRGc9PSIsInZhbHVlIjoiTzBhWGQ4LzJrcTF5bFVYdnJTbm9EK0pHaUI0SlRyRWFPRXAyV0EzOEpXRUVib1RVamNYNnNqcUppN0ZBQlk3aG9sMng0OGtuRmVGd2tacmtibjd4NTIwOEF1cW1GL09NUVErd050UXdKeEdXUWhGSTJVQVFrajZ1cHBqalMzVkoiLCJtYWMiOiJiMzQ5YzUwNDZmM2I4N2VhOTdmMzYwNTQzMjBhZDgzODVkMWRjOTkzMTdhNzk0ZTdlMWIzZDNiNWYxYzc4NTliIiwidGFnIjoiIn0%3D');
    //     return $$decrypted; 
    // } catch (DecryptException $e) {
    //     return $e;
    // }
    return response()->json(Cookie::get('token'));
    return Cookie::get('token');

// ;    return Crypt::decrypt(Cookie::get('tt_session'), true);

    // $a= Crypt::decrypt('');
    return response()->json('!!!!you are in!!!!!') ;
})->middleware('auth:sanctum');

Route::post('login',[profileController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('conversations'                               ,[ConvarsationController::class,'index']); //عرض محادثاتي 
    Route::post('readAllMessages'                            ,[ConvarsationController::class,'readAllMessages']);
    Route::post('countUnReadMessage'                         ,[ConvarsationController::class,'countUnReadMessage']);
    //group 
    Route::post('createGroup'                                ,[ConvarsationController::class,'createGroup']);
    Route::get('users_not_in_group/{id}/'                    ,[ConvarsationController::class,'users_not_in_group']);//invite
    Route::get('conversations/{id}/getParticipants'          ,[ConvarsationController::class,'getParticipants']);//
    Route::post('conversations/participants'                 ,[ConvarsationController::class,'addParticipants']);//add to group
    Route::delete('conversations/{conversation}/participants',[ConvarsationController::class,'removeParticipant']);//remove from group
    Route::post('search_chat'                                ,[ConvarsationController::class,'search_chat' ])->name('search.chat');//dont use 
    //----------------------------------------------------------------------------------------------------------------------------------------


    Route::get('conversations/{id}/messages'   ,[MessageController::class,'index']);             //show 50 messages
    Route::get('conversations/{id}/allMessages',[MessageController::class,'allMessages']);    //show all messages

    Route::post('messages'                     ,[MessageController::class,'store'])->name('api.message.store');//store message
    Route::post('/sound'                       ,[MessageController::class,'storeVoiceRecord']);

    Route::post('readMessage'                  ,[MessageController::class,'readMessage']); //read message if reciver person in chat 
    Route::post('messages/{id}'                ,[MessageController::class,'destroy']); 
    //----------------------------------------------------------------------------------------------------------------------------------------
    

    Route::get('getUsers'       ,[profileController::class,'getUsers']);
    Route::post('search_users'  ,[profileController::class,'search_users'])->name('search.users');
    Route::post('change_pass'   ,[profileController::class,'change_pass'])->name('change_password');
    Route::post('updateImg'     ,[profileController::class,'updateImg'])->name('updateImg');
    Route::post('updateName'    ,[profileController::class,'updateName'])->name('updateName');
    Route::get('getNotification',[profileController::class,'getNotification']);//friends request from database
    Route::get('send'           ,[profileController::class,'sendToFirebase']);
    //----------------------------------------------------------------------------------------------------------------------------------------
    
    Route::apiResource('friend',  FriendController::class);
    Route::post('search_friends',[FriendController::class,'search_friends'])->name('search.friends');
    //----------------------------------------------------------------------------------------------------------------------------------------


    Route::post('pusher/auth'    ,[PusherController::class,'pusherAuth']);
    


    Route::post('cheakToken',function(){
        return response()->json(Auth::user());
    });
});


