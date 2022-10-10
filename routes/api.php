<?php

// use App\Models\Conversation;

use App\Http\Controllers\ConvarsationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PusherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[MessageController::class,'login']);


Route::post('/sound',function(Request $request){


$url=$request->sound;

$img=file_get_contents($url);
 
$path=public_path('voice_records');
if(!File::exists($path))
File::makeDirectory($path,0777,true);
$name=Auth::user()->name.'__'.uniqid().'.wav';
file_put_contents(public_path('voice_records/'.$name), $img);
return response()->json(('voice_records/'.$name));
// Storage::disk('local')->put(public_path('/a.wav') ,$img);

})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('conversations',[ConvarsationController::class,'index']); //عرض محادثاتي 
    Route::post('readAllMessages',[ConvarsationController::class,'readAllMessages']);
    Route::post('readMessage',[ConvarsationController::class,'readMessage']);
    Route::post('countUnReadMessage',[ConvarsationController::class,'countUnReadMessage']);
    
    // Route::get('conversations/{id}',[ConvarsationController::class,'show']); // عرض محادثاتي يس باي 

    Route::get('getUsers',[ConvarsationController::class,'getUsers']);
    
    Route::post('conversations/{conversation}/participants',[ConvarsationController::class,'addParticipant']);
    Route::delete('conversations/{conversation}/participants',[ConvarsationController::class,'removeParticipant']);
    
    // MessengerController
    Route::post('messages'    ,[MessageController::class,'store'])->name('api.message.store');
    Route::post('createGroup'    ,[MessageController::class,'createGroup']);
            
    Route::get('conversations/{id}/messages',[MessageController::class,'index']);
    Route::get('conversations/{id}/allMessages',[MessageController::class,'allMessages']);
    
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
