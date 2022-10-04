<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Friend;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConvarsationController extends Controller
{

 
    public function index(){
       
        $chats =Participant::with(['conversation'
            =>function($query_one){
                $query_one->with(['lastMassege','partiscipants' 
                    =>function($query_two) {
                $query_two->where('id','<>',Auth::id());}
                        ]);
                    }])
            ->where('user_id',Auth::id())->get();
        return($chats);
     
    }
    
    public function getUsers(){
        $friends= User::where('id','<>',Auth::id())->get();
        // return $t;
        $f= DB::table('friends')->
        select('user2_id')->
        where('user1_id',Auth::id())->
        where('acceptable',1)->
        distinct()->
        get()->
        map(function ($query) {
            return $query->user2_id;
          });
        $users = DB::table('users')->where('id','<>',Auth::id())->whereNotIn('id', $f)->get();
        return $users;
    }    
    // public function show( $id){

    //     $chats=Conversation::with([
    //     'lastMassege',
    //     'partiscipants'=>function( $query)  {
    //         $query->where('id','<>',Auth::id());
    //     }
    //  ])
    //   ->where('user_id',Auth::id())->get();
    //  return  $chats;
    //  $chats =Participant::with('conversation')->where('user_id',Auth::id())->get();
    //  // $chats->makeHidden(['conversation_id','user_id','role','joined_at',]);
    //     return  $chats[0]->conversation;
    // }

    public function addParticipant(Request $request ,Conversation $conversation){
        
        $validator = Validator::make($request-> all(),[
                
            'user_id'=>['required','string','exists:users:id'],
          ]);
    
             if ($validator->fails())
             { 
                 $errors = []; foreach ($validator->errors()->messages() as $key => $value) {     $key = 'message';     $errors[$key] = is_array($value) ? implode(',', $value) : $value; }       return response()->json( ['message'=>$errors['message'],'status'=>0],400);
             }
             $conversation->partiscipants()->attach($request->user_id,['joined_at'=>Carbon::now(),]);
        return 'done';
    }


    public function removeParticipant(Request $request ,Conversation $conversation){
        
        $validator = Validator::make($request-> all(),[
                
            'user_id'=>['required','string','exists:users:id'],
          ]);
    
             if ($validator->fails())
             { 
                 $errors = []; foreach ($validator->errors()->messages() as $key => $value) {     $key = 'message';     $errors[$key] = is_array($value) ? implode(',', $value) : $value; }       return response()->json( ['message'=>$errors['message'],'status'=>0],400);
             }
      $conversation->partiscipants()->detach($request->user_id);
        return 'done';
    }
}
