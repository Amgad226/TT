<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Friend;
use App\Models\Notification;
use App\Models\Participant;
use App\Models\User;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class MessengerController extends Controller
{
    public function index($id=null){
       
        $user=User::with('conversation')->find(Auth::id());
        $friends=User::where('id','<>',Auth::id())->get()->sortBy('name');
        
        // $conversations =Conversation::with([ 'partiscipants'=>function( $query)use($id)  {
        //     $query->where('id','<>',Auth::id());
        // }])->where('user_id',Auth::id())->get();

        $chats=Conversation::with([
            'lastMassege',
            'partiscipants'=>function( $query)  {
                $query->where('id','<>',Auth::id());
            }
        ])
        ->where('user_id',Auth::id())->get();

        $chats =Participant::with('conversation')->where('user_id',Auth::id())->get();
        // dd($chats);
        // $chats->makeHidden(['conversation_id','user_id','role','joined_at',]);
        // $chats=$chats;
        // return($chats);

        // foreach ($chats as $chat)
        // {
        //     foreach ($chats as $chat)
        //     {
        //         echo $chat->conversation;
        //     }
        // // }
        // return(1);

            $messages=[];
            $activeChat=new Conversation;
            if($id){
                $activeChat=Conversation::where('id',$id)->first();    
                // return $chat;
                $messages=$activeChat->messages; 
                // dd('d');  
                         
        }
        // return$activeChat;
        $i=new Conversation;
        if($id){
            $i=Conversation::with(['partiscipants'=>function( $query)  {
                $query->where('id','<>',Auth::id());
            }])->where('id',$id)->first();
        // $i =Participant::with('conversation')->where('user_id','<>',Auth::id())->first();
            $i=$i->partiscipants[0]->id;
            
            // return($i->partiscipants[0]->id);
        }
        $recieve_username=new Conversation;
        $recieve_username_d='';
        $recieve_img='';
        if($id){
            $recieve_username=Conversation::with(['partiscipants'=>function( $query)  {
                $query->where('id','<>',Auth::id());
            }])->where('id',$id)->first();
        // $i =Participant::with('conversation')->where('user_id','<>',Auth::id())->first();
            $recieve_username_d=$recieve_username->partiscipants[0]->name;

            $recieve_img=$recieve_username->partiscipants[0]->img;
            
            // return($recieve_username);
        }
        $notifications= Notification::all()->where('owner_id',Auth::id());
       
        return view('messenger',[
            'friends'=>$friends,
            'chats'=>$chats,
            'activeChat'=>$activeChat ,
            'messages'=>$messages,
            'user_id_in_chat'=>$i,
            'recieve_username'=>$recieve_username_d,
            'recieve_img'=>$recieve_img,
            'notifications'=>$notifications,
            'user_id_in_chat'=>$i->partiscipants[0]->id,
        ]);

    }


 
}
