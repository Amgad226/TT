<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Events\MessageCreatedInGroup;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Participant;
use App\Models\Resipient;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Throwable;
// use Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Image;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
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


    public function allMessages($id)
    {
        // dd($id);
        //  date('Y-m-d H:i:s')->diffForhumans() ;
        //  return Carbon::parse(now())->diffForHumans();

        // return now()->diffForHumans();
        // return Message::all();
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


    public function change_pass(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_pass' => 'required',
            'new_pass' => 'required',
            'c_pass' => 'required|same:new_pass',


        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $key = 'message';
                $errors[$key] = is_array($value) ? implode(',', $value) : $value;
            }
            return response()->json(['message' => $errors['message'], 'status' => 0], 200);
        }

        $user = User::find(Auth::id());


        if ((Hash::check($request->get('old_pass'), Auth::user()->password))) {
            $new_password = Hash::make($request->new_password);
            $user->password = $new_password;
            $user->save();
            Notification::create(['owner_id' => Auth::id(), 'user_id' => Auth::id(), 'title' => 'Password Changed', 'body' => 'Your password has been updated successfully..', 'type' => 'password']);

            return response()->json(['status' => 1, 'message' => 'Changed successfully'], 200);
        }

        return response()->json(['status' => 0, 'message' => ' current password is wrong '], 200);
    }

    public function search_users(Request $request)
    {
        $users = User::where('users.name', 'like', "%" . $request->name . "%")->where('id', '<>', Auth::id())->get();
        return $users;
    }



    public function search_chat(Request $request)
    {

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



    public function createGroup(Request $request){
        // return ;
        // return response()->json([    'message' =>$request->img,    'status' => 0], 200);

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
            $extension='.'.$request->img->getclientoriginalextension();
            $path=public_path('/img/group');
            if(!File::exists( $path))
            File::makeDirectory( $path,0777,true);
            $Name= $request->groupName;  
            $uniqid_img='('.uniqid().')';
            $image=$request->file('img') ; 
            $image->move($path,$uniqid_img.$Name.$extension);
            $imgToDB='img/group/'.$uniqid_img.$Name.$extension;
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


    public function store(Request $request)
    {
        
        // dd(1);
        //  return $audio;
        $validator = Validator::make($request->all(), [

            // 'body' => ['string'],//attachment , audio
            'type'=>['required'],
            'attachment'=>'max:15000|mimes:doc,docx,mp3,m4a,wav,pdf,html,jpeg,png,jpg,PNG,JPG,JPEG',
            'img'=> 'mimes:jpeg,png,jpg,PNG,JPG,JPEG',

       
            // 'conversation_id'=>[Rule::requiredIf(function() use ($request)  { return ! $request->input('user_id');}  ),'int', 'exists:conversations:id'],
            // 'user_id'=>[Rule::requiredIf(function() use ($request)  { return ! $request->input('conversation_id');}  ),'int', 'exists:users:id'],

        ]);

        if ($validator->fails()) {$errors = [];foreach ($validator->errors()->messages() as $key => $value) {    $key = 'message';    $errors[$key] = is_array($value) ? implode(',', $value) : $value;}
        return response()->json([    'message' => $errors['message'],    'status' => 0], 400);}
       
        // $type=$request->type;
        // if($type==null)
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
                    'user_id' => $user->id,
                    'type' => $type,
                    'img'=>$reciver_user->img
                ]);
                $conversation->lable='peer';
                $conversation->save;
                
                // $conversation->partiscipants()->attach([$user->id ,$user_id]);
                Participant::create(['user_id' => $user->id, 'conversation_id' => $conversation->id]);
                Participant::create(['user_id' => $user_id, 'conversation_id' => $conversation->id]);
            }

            $request_body=($request->post('body'));   
            $link_attachment='';

            if($request->type=='text'){
                $message = <<<END
                    <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;"><p>{$request_body} <span class="sended  " style="position:relative ;bottom:-12px;right:-10px;z-index:12;visibility:">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    width="15px" height="15px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;"
                    xml:space="preserve"><g>
                   <path fill="var( --bs-white)" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704
                       c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704
                       C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                       </svg>
                
                  </span>
                    </span> </p></div> 
                END;
            }

            else if($request->type=='audio')  {
                $message = <<<END
                <audio style='border: 5px solid #2787F5; border-radius: 50px;'  controls ><source src="{$request_body }" type="audio/WAV"></audio>
               
                END;
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
                $link_attachment = $body->move('attachments',$name.$uniqid.'.'.$body->getclientoriginalextension());
                $message = <<<END
                <div class="message-text">
                  <div class="row align-items-center gx-4">
                      <div class="col-auto">
                          <a href="{$link_attachment}" class="avatar avatar-sm" target="_blank">
                              <div class="avatar-text bg-white text-primary">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
                              </div>
                          </a>
                      </div>
                      <div class="col overflow-hidden">
                          <h6 class="text-truncate text-reset">
                              <a href="#" class="text-reset">{$name}</a>
                          </h6>
                          <ul class="list-inline text-uppercase extra-small opacity-75 mb-0">
                              <li class="list-inline-item">{$stringSize}</li>
                          </ul>
                      </div>
                  </div>
                </div>
                END;
            }
            else if($request->type=='img'){
                $body=$request->file('img');
                $name=$body->getClientOriginalName();

                $image_resize = Image::make($body->getRealPath())->encode($body->getclientoriginalextension());;              
                $image_resize->resize(1280, 720, function ($constraint) {$constraint->aspectRatio(); });
                
                $uniqid=uniqid();
                $name=$body->getClientOriginalName();
                // $link_attachment = $image_resize->move('image',$uniqid.'.'.$body->getclientoriginalextension());
                $image_resize->save(public_path('image/'.$name.$uniqid.'.'.$body->getclientoriginalextension()));
                $link_attachment='image/'.$name.$uniqid.'.'.$body->getclientoriginalextension();

                $message = <<<END
                <img class="img-fluid rounded" src="${link_attachment}" data-action="zoom" alt="">
                END;
            }
            // return 1;
            $message = $conversation->messages()->create([
                //conversation_id  from relation 
                'user_id' => Auth::id(),
                'body' => $message,
                'type' => $request->post('type'),

                ]);
         
            // return $message->conversation ;   
            DB::statement('
            INSERT INTO resipients (user_id,message_id)
            SELECT user_id ,? FROM partiscipants
            WHERE conversation_id=?
            ', [$message->id, $conversation->id]);

            Resipient::where('message_id',$message->id)->where('user_id',Auth::id())->where('read_at',null)->update(['read_at'=>now()]);


            $conversation->update(['last_message_id' => $message->id]);
            DB::commit();
            // $noti= $this->sendNotification( User::where('id',19)->pluck('deviceToken')->all() , Auth::user()->name,$message);
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

            $message['html'] = '<spam class="sended fas fa-check" style=" position:relative ; bottom:-12px; right:-10px; z-index:12; " ></spam> ';
            return response(['obj_msg' => $message, 'link_attachment'=>$link_attachment,'status' => 1 
            // ,'noti'=>$noti
        ]);
        } 
        catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
        // return $user;




    }



    public function destroy($id)
    {
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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email', 'exists:users:email',
            'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->first();
        // dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return ['status' => 0, 'message' => 'Invalid Credentials', 'data' => []];
        }
        $data = [
            'user' => $user,
            'token' => $user->createToken('MyToken')->plainTextToken
        ];
        return $user->createToken('MyToken')->plainTextToken;
        return ['status' => 1, 'message' => 'Login Successful!', 'data' => $data];
    }

    protected function sendNotification($firebaseToken,$title,$body){
             
        // $firebaseToken = User::where('id',1)->pluck('deviceToken')->all();
   
        $SERVER_API_KEY = 'AAAAUaVANXk:APA91bFncgrq3FnMeF_Cnu1W484TFzGBXyYGHV52UANZEufh4kLVwvv-JxlnuBWK8XatvIFnqmsvvf9mx-I2rGeZswH8SajA7C4N1KBBrWYAcV6fr-8npfwfdAWS5Lpx-q_dOrgvJ_-p';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        dd($response);
        return($response);
    }
}
