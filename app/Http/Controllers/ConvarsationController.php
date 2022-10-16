<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Friend;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Resipient;
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
                $query_one->orderBy('last_message_id','asc');
                $query_one->with(['lastMassege','partiscipants' 
                    =>function($query_two) {
                     $query_two->where('id','<>',Auth::id());}
                        ]);
                }])
             ->where('user_id',Auth::id())->get();
     
       
        for ($i = 0; $i < count($chats) ; $i++)
        {
          
            for ($j = 0; $j <  count($chats) - $i -1; $j++)
            { 
                if ($chats[$j]->conversation->last_message_id < $chats[$j+1]->conversation->last_message_id)
                {
                    $temp = $chats[$j];
                    $chats[$j] = $chats[$j + 1];
                    $chats[$j + 1] = $temp;
                }
            }           
  
            // $chats[$i]['conversation']['nameChats']=$this->countUnReadMessage($chats[$i]->conversation->lable);
       
        }
        foreach($chats as $chat ){
            // if($chat->conversation->type=='group')
            // $chat->load('user');
            $chat->conversation['unRead_message']=$this->countUnReadMessage($chat->conversation_id);
        }
        
        return($chats);
    }

    public function countUnReadMessage( $conversation_id= 2){
   
        // $validator = Validator::make($request-> all(),[
                
        //     'conversation_id'=>['required','exists:conversations,id'],
        //   ]);
    
        //      if ($validator->fails())
        //      { 
        //          $errors = []; foreach ($validator->errors()->messages() as $key => $value) {     $key = 'message';     $errors[$key] = is_array($value) ? implode(',', $value) : $value; }       return response()->json( ['message'=>$errors['message'],'status'=>0],200);
        //      }

             
 
            $a =DB::table('conversations')->select('messages.id')->
            join('messages','conversations.id','=','messages.conversation_id')->
            join('resipients','messages.id','=','resipients.message_id')->
            where('resipients.read_at',null)->
            where('resipients.user_id',Auth::id())->
            where('conversations.id',$conversation_id)->
            count()  ;
            return $a;

            $ss=Resipient::where('user_id',Auth::id())->whereIn('message_id',$a)->where('read_at',null)->count();
            // $ss=Resipient::where('user_id',Auth::id())->whereIn('message_id',$a)->where('read_at',null)->update(['read_at'=>now()]);
            return $ss;
        

    }


    public function readAllMessages(Request $request ){
   
        $validator = Validator::make($request-> all(),[
                
            'conversation_id'=>['required','exists:conversations,id'],
          ]);
    
             if ($validator->fails())
             { 
                 $errors = []; foreach ($validator->errors()->messages() as $key => $value) {     $key = 'message';     $errors[$key] = is_array($value) ? implode(',', $value) : $value; }       return response()->json( ['message'=>$errors['message'],'status'=>0],200);
             }

             
 
            $a =DB::table('conversations')->select('messages.id')->
            join('messages','conversations.id','=','messages.conversation_id')->
            where('conversations.id',$request->conversation_id)->
            get()  ->map(function($e){
                return $e=$e->id;
            }) ;   

        
            // $ss=Resipient::where('user_id',Auth::id())->whereIn('message_id',$a)->where('read_at',null)->count();
            $ss=Resipient::where('user_id',Auth::id())->whereIn('message_id',$a)->where('read_at',null)->update(['read_at'=>now()]);
            return $ss;
        

    }




    public function readMessage(Request $request ){
   
        $validator = Validator::make($request-> all(),[
                
            'message_id'=>['required','exists:messages,id'],
          ]);
    
             if ($validator->fails())
             { 
                 $errors = []; foreach ($validator->errors()->messages() as $key => $value) {     $key = 'message';     $errors[$key] = is_array($value) ? implode(',', $value) : $value; }       return response()->json( ['message'=>$errors['message'],'status'=>0],200);
             }

        //  return $request->message_id; 
        //  sleep(2);
             $a=Resipient::where('message_id',$request->message_id)->where('user_id',Auth::id())->where('read_at',null)->update(['read_at'=>now()]);
            //  $a->update(['read_at'=>now()]);
            // return $a ;
             return $a;


    }




    public function getUsers(){
        
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
                
            'user_id'=>['required','string','exists:users,id'],
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
                
            'user_id'=>['required','string','exists:users,id'],
          ]);
    
             if ($validator->fails())
             { 
                 $errors = []; foreach ($validator->errors()->messages() as $key => $value) {     $key = 'message';     $errors[$key] = is_array($value) ? implode(',', $value) : $value; }       return response()->json( ['message'=>$errors['message'],'status'=>0],400);
             }
          $conversation->partiscipants()->detach($request->user_id);
        return 'done';
    }
}
