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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Image;
use Illuminate\Support\Facades\Storage;


class ConvarsationController extends Controller
{

 
    public function index(){
           //    return 1;
        $chats =Participant::with(['conversation'
            =>function($query_one){
                $query_one->orderBy('last_message_id','asc');
                $query_one->with(['lastMassege','partiscipants' 
                    =>function($query_two) {
                        // return($query_two);
                     $query_two->where('id','<>',Auth::id());
                    }
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
            // $chats[$i]->conversation['unRead_message']=$this->countUnReadMessage($chats[$i]->conversation_id);
  
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

 

    public function createGroup(Request $request){
   
        $validator = Validator::make($request->all(), [
            // 'message' => ['required', 'string'],

            'users_id*' => [],
            'groupName'=>['required'],
            'groupDescription'=>['required'],
            'img'=>'mimes:jpg,png,jpeg,gif,svg|max:2048',
            // 'img'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        // dd(gettype($request->users_id));
    
  
        if ($validator->fails()) {$errors = [];foreach ($validator->errors()->messages() as $key => $value) {    $key = 'message';    $errors[$key] = is_array($value) ? implode(',', $value) : $value;}return response()->json([    'message' => $errors['message'],    'status' => 0], 200);}
        $users_id = explode(",", $request->users_id);
    
        if (request()->hasFile('img')){
            // $extension='.'.$request->img->getclientoriginalextension();
            // $path=public_path('/img/group');
            // if(!File::exists( $path))
            // File::makeDirectory( $path,0777,true);
            // $Name= $request->groupName;  
            // $uniqid_img='('.uniqid().')';
            // $image=$request->file('img') ; 
            // $image->move($path,$uniqid_img.$Name.$extension);
            // $imgToDB='img/group/'.$uniqid_img.$Name.$extension;


            $body=$request->file('img');
            $image_resize = Image::make($body->getRealPath())->encode($body->getclientoriginalextension());;              
            $image_resize->resize(1280, 720, function ($constraint) {$constraint->aspectRatio(); });
            
            
            $name=$request->groupName;
            $extension=$body->getclientoriginalextension();
            $uniqid=uniqid();
    
        
    
            Storage::disk('google')->put('group/'.$name.$uniqid.'.'.$extension ,$image_resize,  );
            $imgToDB = Storage::disk('google')->url('group/'.$name.$uniqid.'.'.$extension);  
            
        }
        // dd( $imgToDB);
        //  array_push($users_id,(string)Auth::id());
         // dd($users_id);

        $groupName=($request->groupName!=null)?$request->groupName:'group';
        $group=Conversation::create([
            'user_id',Auth::id(),
            'lable'=>$groupName,
            'type'=>'group',
            'img'=>$imgToDB,
            'description'=>$request->groupDescription,
        ]);
        $group->update(['user_id'=>Auth::id()]);

        foreach($users_id as $user_id){
            Participant::create(['user_id' => $user_id, 'conversation_id' => $group->id]);
        }
        Participant::create(['user_id' => Auth::id(), 'conversation_id' => $group->id ,'role'=>'admin' ]);

        return response()->json([    'message' => 'group created successfuly',    'status' => 1], 200);
    }
 
    
    public function countMessageInConversation($user_id,$conversation_id){

     return Message::where([['conversation_id',$conversation_id],['user_id',$user_id]])->count();
    }

    public function users_not_in_group($id){

        // Conversation::find($id);
        $friend_users= DB::table('friends')->where([['user1_id',Auth::id()],['acceptable',1]])->orWhere([['user2_id',Auth::id()],['acceptable',1]])->get(['id','user1_id','user2_id']);

        $idd=[];
            foreach($friend_users as $u )
            { 
                if($u->user1_id != Auth::id())
                array_push($idd,$u->user1_id );
                else
                 array_push($idd,$u->user2_id );
            }

        $users_id_in_chat=DB::select('SELECT users.id FROM users 
        JOIN partiscipants on partiscipants.user_id = users.id 
        WHERE partiscipants.conversation_id=?',[$id]);

         $ids_in_chat=[];
        foreach($users_id_in_chat as $user_id_in_chat)
        {
         array_push($ids_in_chat,$user_id_in_chat->id);
        }
        // return $ids_in_chat;



     return    DB::table('users')
            ->select('name','id','img')
            ->whereIn('id',$idd)
            ->whereNotIn('id',$ids_in_chat)
            ->get();


        //     return   DB::select('
        // SELECT name , id,img from users
        // where id in (2,3) and
        //  id not IN (SELECT users.id FROM `users` 
        // JOIN partiscipants on partiscipants.user_id = users.id 
        // WHERE partiscipants.conversation_id=?)
        // ',[$id]);
        // ',[$o,$id]);
    }


    public function getParticipants( $id){

        //with query 
        $participant=Participant::with(['user'=>function($query1){
            $query1->groupBy('id');
            $query1->select('id','name','img');
        }] )
         ->withCount(['message'=>function($query2) use($id){
            $query2->where('conversation_id',$id);
         }])

         ->where('conversation_id',$id)
        //  ->select('conversation_id','user_id',)
         ->get();

         $participant->makeHidden(['conversation_id','user_id']);
         return $participant;

     //with php
     // $conversation= Conversation::with(['partiscipants'])->find($id);
     //     foreach( $conversation->partiscipants as $q)
     //     {
     //         // return $q->id;
     //         $q['countMessages']=$this->countMessageInConversation($q->id,$id);
     //     }
     //     $conversation->makeHidden(['user_id','lable','img','last_message_id','description','type']);
     //     $conversation->partiscipants->makeHidden(['email','email_verified_at','created_at','updated_at','pivot']);
 
     //     return $conversation; 

    }

    public function addParticipants(Request $request ){
        
        $validator = Validator::make($request-> all(),[
            'conversation_id'=>['required','exists:conversations,id'],
            'users_id'=>['required','exists:users,id'],
          ]);

        if ($validator->fails())
        { 
            $errors = []; foreach ($validator->errors()->messages() as $key => $value) {     $key = 'message';     $errors[$key] = is_array($value) ? implode(',', $value) : $value; }       return response()->json( ['message'=>$errors['message'],'status'=>0],400);
        }
        $users_id = explode(",", $request->users_id);
        
        foreach($users_id as $user_id){
            
            Participant::create(['conversation_id'=>$request->conversation_id,'user_id'=>$user_id,'joined_at'=>Carbon::now()]);
                //  Participant::attach($user_id,['joined_at'=>Carbon::now(),]);
             }
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


    public function search_chat(Request $request)
    {
        return;
        $search = DB::table('partiscipants')->
        // select('conversations.id as conversation_id' , 'conversations.img','messages.type as lastMessageType','messages.body', 'users.name', 'messages.created_at'
        select('conversations.id as conversation_id'
            )->join(
                'partiscipants as par2',
                'partiscipants.conversation_id',
                '=',
                'par2.conversation_id'
            )->join(
                'users',
                'users.id',
                '=',
                'par2.user_id'
            )->join(
                'conversations',
                'conversations.id',
                '=',
                'partiscipants.conversation_id'
            )->join(
                'messages',
                'messages.id',
                '=',
                'conversations.last_message_id'
            )->where(
                'partiscipants.user_id', '<>', 'par2.user_id'
            )->where('partiscipants.user_id', '=', Auth::id()
            )->where('par2.user_id', '<>', Auth::id()
            // )->where('users.name', 'like', "%" . $request->name . "%"
            )->get() 
            
            ->map(function($e){
                return $e=$e->conversation_id;
            }) ;   
        //  return   Conversation::lable();
            $searchd = Conversation::where('lable', 'like', "%" . $request->name . "%")->get();
          return  $searchd->namee();
        return $searchd;
        // dd($search);

    }
}
