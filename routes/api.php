<?php

// use App\Models\Conversation;

use App\Http\Controllers\ConvarsationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\PusherController;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('testQuery/{id}',function($id){
$user_id=1;

    return Conversation::with([
        'partiscipants'=>function($query){$query->select('id','name','img');},
        'lastMassege'=>function($query){$query->select('id','body','type','created_at',);}])
        ->select('id','lable','img','type','description','last_message_id')
        ->join('partiscipants', 'conversations.id', '=', 'partiscipants.conversation_id')
        ->where('partiscipants.user_id', $user_id)
        ->orderBy('conversations.last_message_id', 'desc')
        ->selectRaw('(SELECT COUNT(*) FROM messages 
        JOIN resipients ON messages.id = resipients.message_id
        WHERE messages.conversation_id = conversations.id AND 
        resipients.read_at IS NULL 
        AND resipients.user_id = ?) 
        AS unRead_message', [$user_id])
        ->get();


    $userID= 1;
    return DB::table('users')
    ->select('name', 'id', 'img')
    ->whereIn('id', function ($query)use ($userID) {
        $query->selectRaw('CASE WHEN user1_id = ? THEN user2_id ELSE user1_id END AS friend_id', [$userID])
            ->from('friends')
            ->where('user1_id', $userID)
            ->orWhere('user2_id', $userID)
            ->where('acceptable', $userID);
    })
    ->whereNotIn('id', function ($query) use ($id) {
        $query->select('user_id')
            ->from('partiscipants')
            ->where('conversation_id', $id);
    })
    ->get();

});

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
    Route::post('search_chat'                                ,[ConvarsationController::class,'search_chat' ])->name('search.chat');//don't use
    //----------------------------------------------------------------------------------------------------------------------------------------


    Route::get('conversations/{conversation}/messages'   ,[MessageController::class,'index']); 

    Route::post('messages'                     ,[MessageController::class,'store'])->name('api.message.store');//store message

    Route::post('/sound'                       ,[MessageController::class,'storeVoiceRecord']);

    Route::get('readMessage/{message}'                  ,[MessageController::class,'readMessage']); //read message if reciver person in chat
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

    Route::post('updateFirebaseToken',function(Request $request){
        // Auth::user()->deviceToken=$request->firebaseToken;
        User::find(Auth::id())->update(['deviceToken'=>$request->firebaseToken]);
        return true;
    });
    Route::get('disableNoti',function(){
        // Auth::user()->deviceToken=$request->firebaseToken;
        User::find(Auth::id())->update(['deviceToken'=>'']);
        return true;
    });
});

Route::post('a'           ,[profileController::class,'a']);

