<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Events\MessageCreatedInGroup;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Resipient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Image;

class MessageController extends Controller
{

    public function index($id){
        // dd($id);
        $conversation = Conversation::with([
            'partiscipants'  => function ($query_two) {
                $query_two->where('id', '<>', Auth::id());
            }
        ])->findOrFail($id);
        // $allMessagesInChat=Message::where('conversation_id', $id)->count();
        $allMessagesInChat=DB::table('messages')->where('deleted_at',null)->where('conversation_id', $id)->count();
        $limit=50;
        
        $messages = Message::with('user')->where('conversation_id', $id)->limit($limit)->skip($allMessagesInChat-$limit)->get();
        // $messages =DB::table('messages')
        // ->select('messages.id','messages.user_id','body','type','messages.created_at','users.img','users.name')
        // ->join('users','users.id','=','messages.user_id')
        // ->where('conversation_id', $id)->limit($limit)->skip($allMessagesInChat-$limit)->get();

        $read_more=( $allMessagesInChat > count($messages)) ?1 :0;

        // $message = Message::with('user')->where('conversation_id', $id)->get();
        return [
            'conversation' => $conversation,
            'messeges' => $messages,
            'read_more'=>$read_more,

            // 'messeges'=>$conversation->messages()->with('user'),
        ];
    }

    public function allMessages($id){
   
        $conversation = Conversation::with([
            'partiscipants'  => function ($query_two) {
                $query_two->where('id', '<>', Auth::id());
            }
        ])->findOrFail($id);
    
        // $allMessagesInChat=DB::table('messages')->where('conversation_id', $id)->count();
        $allMessagesInChat=Message::where('conversation_id', $id)->count();
        $limit=8000;
        
        // $messages =DB::table('messages')
        // ->select('messages.id','messages.user_id','body','type','messages.created_at','users.img','users.name')
        
        // ->join('users','users.id','=','messages.user_id')
        // ->where('conversation_id', $id)
        // ->limit($limit)->skip($allMessagesInChat-$limit)
        // ->get();
        $messages = Message::with('user')->where('conversation_id', $id)->limit($limit)->skip($allMessagesInChat-$limit)->get();

        // $messages =DB::table('messages')
        // ->select('messages.id','messages.user_id','body','type','messages.created_at','users.img','users.name')
        // ->join('users','users.id','=','messages.user_id')
        // ->where('conversation_id', $id)
        // ->limit($limit)
        // // ->skip($allMessagesInChat-$limit)
        // ->get();
            // $messages->makeHidden([
            //     'email','email_verified_at',''
            // ]);
        // $message = Message::with('user')->where('conversation_id', $id)->get();
        return [
            'conversation' => $conversation,
            'messeges' => $messages,

            // 'messeges'=>$conversation->messages()->with('user'),
        ];
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

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [

            // 'body' => ['string'],//attachment , audio
            'type'=>['required'],
            'attachment'=>'max:15000|mimes:doc,docx,mp3,m4a,mp4,wav,pdf,html,jpeg,png,jpg,PNG,JPG,JPEG,webp',
            'img'=> 'mimes:jpeg,png,jpg,PNG,JPG,JPEG,webp',

        ]);

        if ($validator->fails()) {$errors = [];foreach ($validator->errors()->messages() as $key => $value) {    $key = 'message';    $errors[$key] = is_array($value) ? implode(',', $value) : $value;}
        return response()->json([    'message' => $errors['message'],    'status' => 0], 400);}
       
   
        $type='peer';

        $user = Auth::user();
        $conversation_id = $request->conversation_id;
        $user_id = $request->user_id;
        $reciver_user=User::find($user_id);
        DB::beginTransaction();
        try {

            if ($conversation_id) {
                //اذا باعتلي 
                //conversation_id
                //ف المحادثة موجودة ورح ابعت الرسالة عهي المحادثة 
                $conversation = Conversation::findOrFail($conversation_id);
                // return($conversation->partiscipants->where('id','<>',Auth::id())->first()->img);
                $type=$conversation->type;
                // dd();

            } 
            else {

                /* 
                اذا  ما باعتلي 
                conversation_id
                 ف انا رح دور ازا في محادثة موجودة بينني وبيين ال 
                user_id
                يلي بعتلي ياه وازا في محادثة رح حطها ب 
                 $conversation
                 والا رح حط فيها فولس 
                */
                $conversationn = DB::table('conversations')->
                join('partiscipants', 'conversations.id', '=', 'partiscipants.conversation_id')->
                join('partiscipants as par2', 'partiscipants.conversation_id', '=', 'par2.conversation_id')->
             
                where([['partiscipants.user_id', Auth::id()],['conversations.type','peer'], ['par2.user_id', $request->user_id]])->
                orWhere([['partiscipants.user_id', $request->user_id],['conversations.type','peer'],  ['par2.user_id', Auth::id()]])->
                first();
                // return $conversationn;
                if ($conversationn != null) {
                     $conversation = Conversation::find($conversationn->id);
                }
                 else {
                    $conversation = false;
                }
            }
            if (!$conversation) {
                // $name=$type=='peer'?$reciver_user->name:'group';
               

                $conversation = Conversation::create([
                    'user_id' => Auth::id(),
                    'type' => $type,
                    'img'=>$reciver_user->img
                ]);
                $conversation->lable='peer';
                $conversation->save;
                
                // $conversation->partiscipants()->attach([Auth::id() ,$user_id]);
                Participant::create(['user_id' => Auth::id(), 'conversation_id' => $conversation->id]);
                Participant::create(['user_id' => $user_id , 'conversation_id' => $conversation->id]);
            }

            $request_body=($request->post('body'));   
            $link_attachment='';
            $attachment='';

            if($request->type=='text'){


                $message=$request_body;

                // $message = <<<END
                //     <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;">
                //         <p>{$request_body} 
                //             <span class="sended  " style="position:relative ;bottom:-12px;right:-10px;z-index:0;visibility:">
                //                 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="15px" height="15px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;"xml:space="preserve"><g><path fill="var( --bs-white)" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                //                 </svg>
                //             </span>
                //         </p>
                //     </div> 
                // END;
            }

            else if($request->type=='audio')  {
                $message = $request_body ;
                $link_attachment=$request_body;
                // return $message;
                // $message = <<<END
                // <audio style='border: 5px solid #2787F5; border-radius: 50px;'  controls ><source src="{$request_body }" type="audio/WAV"></audio>
                // <span   style="position:absolute;right:23px; z-index:120;visibility:visiable"> 
                // <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;" xml:space="preserve"><g>
                //    <path fill="#2787F5" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704 c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704 C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                // </svg>
                // </span>
                // END;
            }

            else if($request->type=='attachment')   {

                $body=$request->file('attachment');
                $size=(int) (($body->getSize())/1000);
                $stringSize=$size.'KB';
                if($size>1000){
                    $size/=1000;
                    $stringSize=$size.'MB';
                }
                
                $uniqid=uniqid();
                
                $name=$body->getClientOriginalName();
                $extension=$body->getclientoriginalextension();

                $image_resize=$body;

                if(config('app.storeGoogleDrive')==true){
                    $a= storage::disk('google')->put('attachment',$image_resize  );
                    $link_attachment = Storage::disk('google')->url($a);
                }
                else
                $link_attachment = $body->move('attachments',$name.$uniqid.'.'.$extension);

     

             
                $attachment=[
                    'link_attachment'=>(string)$link_attachment,
                    'stringSize'=>$stringSize,
                    'name'=>$name,
                ];
                
                 //   $link_attachment = Storage::disk('google')->url('image/'.$name.$uniqid.'.'.$extension);      
               
                // return $link_attachment;
                
                // $message = <<<END
                // <div class="message-text">
                //   <div class="row align-items-center gx-4">
                //       <div class="col-auto">
                //           <a href="{$link_attachment}" class="avatar avatar-sm" target="_blank">
                //               <div class="avatar-text bg-white text-primary">
                //                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
                //               </div>
                //           </a>
                //       </div>
                //       <div class="col overflow-hidden">
                //           <h6 class="text-truncate text-reset">
                //               <a href="#" class="text-reset">{$name}</a>
                //           </h6>
                //           <ul class="list-inline text-uppercase extra-small opacity-75 mb-0">
                //               <li class="list-inline-item">{$stringSize}</li>
                //           </ul>
                //       </div>
                //   </div>
                // </div>
                // END;
                $message=  $link_attachment ;

            }
            else if($request->type=='img'){

                $body=$request->file('img');
                $name=$body->getClientOriginalName();
                $extension=$body->getclientoriginalextension();

                $image_resize = Image::make($body->getRealPath())->encode($body->getclientoriginalextension());;              
                // $image_resize->resize(1280, 720, function ($constraint) {$constraint->aspectRatio(); });
                $image_resize->resize(600, 300, function ($constraint) {$constraint->aspectRatio(); });
                
                $uniqid=uniqid();
                $name=$body->getClientOriginalName();
               
                if(config('app.storeGoogleDrive')==true){
         
                Storage::disk('google')->put('image/'.$name.$uniqid.'.'.$extension ,$image_resize,  );
                $link_attachment = Storage::disk('google')->url('image/'.$name.$uniqid.'.'.$extension);      
                }
                else{
                    // $link_attachment=$image_resize->move('image/'.$name.$uniqid.$extension);

                    $image_resize->save(public_path('image/'.$name.$uniqid.'.'.$extension));
                    $link_attachment='image/'.$name.$uniqid.'.'.$extension;
                }

                $message=$link_attachment;
                // $message = <<<END
                // <img  width="200"  class="img-fluid rounded" src="${link_attachment}" data-action="zoom" alt="">
                // END;
                // $message=$request->post('type');
            }
            
            $message = $conversation->messages()->create([
                //conversation_id  from relation 
                'user_id' => Auth::id(),
                'body' => $message,
                'type' => $request->post('type'),

                ]);
                if($request->post('type')=='attachment'){
                    $message->update(['attachment'=>$attachment]);
                }
         
            DB::statement('
            INSERT INTO resipients (user_id,message_id)
            SELECT user_id ,? FROM partiscipants
            WHERE conversation_id=?
            ', [$message->id, $conversation->id]);

            // Resipient::create(['user_id'=>Auth::id(),'message_id'=>$message->id]);
            // Resipient::create(['user_id'=>$user_id ,'message_id'=>$message->id]);
            // Resipient::where('message_id',$message->id)->where('user_id',Auth::id())->where('read_at',null)->update(['read_at'=>now()]);
      

            Resipient::where('message_id',$message->id)->where('user_id',Auth::id())->where('read_at',null)->update(['read_at'=>now()]);


            $conversation->update(['last_message_id' => $message->id]);
            DB::commit();
            $message->load('user');
     
            // return($type);
           $other_users= $message->conversation->partiscipants()->where('user_id','<>',Auth::id())->get();
            // return($other_user[1]);

            if($type=='group')
            {
                foreach( $other_users as  $other_user){

            // return($message );

                    event(new MessageCreatedInGroup($message , $other_user));
                }
            }
            else{

                event(new MessageCreated($message ,$type));
            }

            // $message['html'] = '<spam class="sended fas fa-check" style=" position:relative ; bottom:-12px; right:-10px; z-index:12; " ></spam> ';
            return response([
            'obj_msg' => $message,
            'link_attachment'=>$link_attachment,
            'status' => 1 ,
            'message_id'=>$message->id,
            'attachment'=>$attachment
            // ,'noti'=>$noti
        ]);
        } 
        catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
        // return $user;




    }

    public function storeVoiceRecord(Request $request){
        $url=$request->sound;

        $img=file_get_contents($url);
        $name=Auth::user()->name.'__'.uniqid().'.wav';

     
        if(config('app.storeGoogleDrive')==true){
        $storedRecord= storage::disk('google')->put('voiceRecord/'.$name,$img  );
        $linkRecord = Storage::disk('google')->url();
        return response()->json($linkRecord);
        }

        else{
        $path=public_path('voice_records');
        if(!File::exists($path))
        File::makeDirectory($path,0777,true);
        file_put_contents(public_path('voice_records/'.$name), $img);
        return response()->json(('voice_records/'.$name));
        }
        

    }    

    public function destroy($id){
        $message=Message::find($id);
     //     $message->update([
     //         'body'=>'<div class="message-content">
        
     //         <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;">
     //             <p>deleted message  
     //                 <span class="sended  fas fa-check" style="position:relative ;bottom:-12px;right:-10px;z-index:12;visibility:"></span> 
     //             </p>
     //         </div> 
     //    </div>  '
     //   ]);
        $message->delete();
        return ' message deleted . . .';
        // Resipient::where(['user_id' => Auth::id(), 'message_id' => $id])->delete();
        // return ['message' => 'done '];
    }

}   
