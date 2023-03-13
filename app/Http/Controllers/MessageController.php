<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Events\MessageCreatedInGroup;
use App\Http\Requests\storeMessageRequest;
use App\Jobs\sendNotification;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Resipient;
use App\Models\User;
use App\services\ConversationService;
// use App\services\ConversationService;
use App\services\MessageConversationService;
use App\services\StoreMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Image;

class MessageController extends Controller
{

    public function index(Conversation  $conversation) {

        $page= (request('page') ) ? request('page')  :1 ;

        $limit=  config('global.number_of_message_to_read')  * $page;

        $ConversationService = new MessageConversationService( $conversation, Auth::id(), $limit);

        $data=$ConversationService->index();

        return [
            'conversation' => $data['conversation'],
            'messeges'     => $data['messages'],
            'read_more'=> $data['read_more'],
        ];
    }


    public function readMessage(Message $message ):void{

             Resipient::where('message_id',$message->id)->where('user_id',Auth::id())->where('read_at',null)->update(['read_at'=>now()]);

             return ;
    }

    public function store(storeMessageRequest $request){
        $type='peer';
        $attachment='';
        $notificationBody=$request->type;
        $conversation_id = $request->conversation_id;
        DB::beginTransaction();
        try {
            $conversationService=new ConversationService();
            $conversation=$conversationService->getConversationToStore( $conversation_id ,Auth::id() ,$request->user_id );


            $service= new StoreMessageService($request);
            $msg=$service->storeMessage();


            $message = $conversation->messages()->create([
                'user_id' => Auth::id(),
                'body' => $msg['message'],
                'type' => $request->post('type'),
            ]);

            if($request->post('type')=='attachment'){
                $attachment=$msg['attachment'];
                $message->update(['attachment'=> $attachment]);
            }

            DB::statement(' INSERT INTO resipients (user_id,message_id) SELECT user_id ,? FROM partiscipants WHERE conversation_id=? ', [$message->id, $conversation->id]);

            Resipient::where('message_id',$message->id)->where('user_id',Auth::id())->where('read_at',null)->update(['read_at'=>now()]);

            $conversation->update(['last_message_id' => $message->id]);

            DB::commit();


            $message->load('user');


           $other_users= $message->conversation->partiscipants()->where('user_id','<>',Auth::id())->get();

            if($type=='group'){
                foreach( $other_users as  $other_user){
                    event(new MessageCreatedInGroup($message , $other_user));
                }
            }
            else{
                event(new MessageCreated($message ,$type));
            }

            $this->sendToFirebase($conversation->id, $conversation->lable,$notificationBody);

            return response([
            'obj_msg' => $message,
            'link_attachment'=>$msg['message'],
            'status' => 1 ,
            'message_id'=>$message->id,
            'attachment'=>$attachment
        ]);
        }
        catch (Throwable $e) {
            // echo 1234;
            DB::rollback();
            throw $e;
        }

    }
    private function sendToFirebase($conversation_id,$title='new message',$body):void{
        $participants=Participant::where('conversation_id',$conversation_id)->where('user_id','<>',Auth::id())->get('user_id');
        // $a=[];
        foreach($participants as $participant )
         {
             $firebaseToken = User::where('id',$participant->user_id)->pluck('deviceToken')->all();

             $SERVER_API_KEY = config('global.FIREBASE_SERVER_API_KEY');

             $data = [
                 "registration_ids" => $firebaseToken,
                 "notification" => [
                     "title" =>$title,
                     "body" => $body,
                     "content_available" => true,
                     "icon"=>asset('logo.png'),
                     "click_action"=>'/',
                     "priority" => "high",
                     // "vibrate"=> [200, 100, 200, 100, 200, 100, 200],
                     // "tag"=> 'vibration-sample'
                 ]
             ];
             $dataString = json_encode($data);

             $headers = [
                 'Authorization: key=' . $SERVER_API_KEY,
                 'Content-Type: application/json',
             ];

             sendNotification::dispatch($headers,$dataString);

         }


    }
    public function storeVoiceRecord(storeMessageRequest $request){
        $url=$request->sound;

        $img=file_get_contents($url);
        $name=Auth::user()->name.'__'.uniqid().'.wav';


        if(config('app.storeGoogleDrive')==true){
            $storedRecord= storage::disk('google')->put('voiceRecord/'.$name,$img  );
            $linkRecord = Storage::disk('google')->url('voiceRecord/'.$name,$img);

            $request['body']=$linkRecord;
            return  $this->store($request);
        // return response()->json($linkRecord);
        }

        else{
        $path=public_path('voice_records');
        if(!File::exists($path))
        File::makeDirectory($path,0777,true);
        file_put_contents(public_path('voice_records/'.$name), $img);

        $request['body']='voice_records/'.$name;
       return  $this->store($request);
        // return response()->json(('voice_records/'.$name));
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
