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


        $message = Message::with('user')->where('conversation_id', $id)->get();
        return [
            'conversation' => $conversation,
            'messeges' => $message,
            // 'messeges'=>$conversation->messages()->with('user'),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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

        $search = DB::table('partiscipants')->select('partiscipants.conversation_id', 'messages.body', 'users.name', 'messages.created_at')->join(
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
            )->where('partiscipants.user_id', '<>', 'par2.user_id')->where('partiscipants.user_id', '=', Auth::id())->where('par2.user_id', '<>', Auth::id())->where('users.name', 'like', "%" . $request->name . "%")->get();
        return $search;
        // dd($search);

    }



    public function createGroup(Request $request){
        $validator = Validator::make($request->all(), [
            // 'message' => ['required', 'string'],

            'users_id*' => [],
            'groupName'=>[],
            'img'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        // dd(gettype($request->users_id));
    
  
        if ($validator->fails()) {$errors = [];foreach ($validator->errors()->messages() as $key => $value) {    $key = 'message';    $errors[$key] = is_array($value) ? implode(',', $value) : $value;}return response()->json([    'message' => $errors['message'],    'status' => 0], 200);}
        $users_id = explode(",", $request->users_id);
    
        if (request()->hasFile('img')){
            $extension='.'.$request->img->getclientoriginalextension();
            $path=public_path('/img/group');
            // dd($path);
            if(!File::exists( $path))
            File::makeDirectory( $path,0777,true);
            $Name= $request->groupName;  
            $uniqid_img='('.uniqid().')';
            $image=$request->file('img') ; 
            $image->move($path,$uniqid_img.$Name.$extension);
            $imgToDB='img/group/'.$uniqid_img.$Name.$extension;
        }
        // dd( $imgToDB);
         array_push($users_id,(string)Auth::id());
         // dd($users_id);

        $groupName=($request->groupName!=null)?$request->groupName:'group';
        $group=Conversation::create([
            'user_id',Auth::id(),
            'lable'=>$groupName,
            'type'=>'group',
            'img'=>$imgToDB,
        ]);
        $group->update(['user_id'=>Auth::id()]);

        foreach($users_id as $user_id){
            Participant::create(['user_id' => $user_id, 'conversation_id' => $group->id]);
        }
        return 'ok';

    }


    public function store(Request $request)
    {
        
        // dd(1);
//  return $audio;
        $validator = Validator::make($request->all(), [

            'message' => ['string'],
            'type'=>[],
            // 'conversation_id'=>[Rule::requiredIf(function() use ($request)  { return ! $request->input('user_id');}  ),'int', 'exists:conversations:id'],
            // 'user_id'=>[Rule::requiredIf(function() use ($request)  { return ! $request->input('conversation_id');}  ),'int', 'exists:users:id'],

        ]);

        if ($validator->fails()) {$errors = [];foreach ($validator->errors()->messages() as $key => $value) {    $key = 'message';    $errors[$key] = is_array($value) ? implode(',', $value) : $value;}return response()->json([    'message' => $errors['message'],    'status' => 0], 200);}
       
        $type=$request->type;
        if($type==null)
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
            } else {

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
                $name=$type=='peer'?$reciver_user->name:'group';
               

                $conversation = Conversation::create([
                    'user_id' => $user->id,
                    'type' => $type,
                    'img'=>$reciver_user->img
                ]);
                $conversation->lable=$name.'  '.Auth::user()->name;
                $conversation->save;
                
                // $conversation->partiscipants()->attach([$user->id ,$user_id]);
                Participant::create(['user_id' => $user->id, 'conversation_id' => $conversation->id]);
                Participant::create(['user_id' => $user_id, 'conversation_id' => $conversation->id]);
            }

            if($request->messageType!='audio'){
                $msg=$request->message;
                $text = <<<END
                    <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;"><p>{$msg} <span class="sended  fas fa-check" style="position:relative ;bottom:-12px;right:-10px;z-index:12;visibility:"></span> </p></div> 
                END;
                  

                   $message = $conversation->messages()->create([
                //conversation_id  from relation 
                'user_id' => Auth::id(),
                'body' => $text,
            ]);
            }
            else{
                $request_body=($request->post('body'));
                $record_location = <<<END
                {{asset('{$request_body}')}}
                END;
        
                $audio = <<<END
                <audio style='border: 5px solid #2787F5; border-radius: 50px;'  controls ><source src="{$request_body }" type="audio/WAV"></audio>
                END;
                $message = $conversation->messages()->create([
                    //conversation_id  from relation 
                    'user_id' => Auth::id(),
                    'body' =>$audio,
                    'type' => $request->post('messageType'),
                ]);
            }
         
            // return $message->conversation ;   
            DB::statement('
            INSERT INTO resipients (user_id,message_id)
            SELECT user_id ,? FROM partiscipants
            WHERE conversation_id=?
            ', [$message->id, $conversation->id]);
            // return($to->user_id);

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

            $message['html'] = '<spam class="sended fas fa-check" style=" position:relative ; bottom:-12px; right:-10px; z-index:12; " ></spam> ';
            return response(['obj_msg' => $message, 'status' => 1]);
        } 
        catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
        // return $user;




    }



    public function destroy($id)
    {

        Resipient::where(['user_id' => Auth::id(), 'message_id' => $id])->delete();
        return ['message' => 'done '];
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
}
