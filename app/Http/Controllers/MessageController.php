<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Http\Requests\storeMessageRequest;
use App\Jobs\sendNotification;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Resipient;
use App\Models\User;
use App\services\ConversationService;
use App\services\MessageConversationService;
use App\services\StoreMessageService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Throwable;
class MessageController extends Controller
{
    public function index(Conversation  $conversation) {


        $ConversationService = new MessageConversationService( $conversation, Auth::id(), (request('page') ) ? request('page')  :1);

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
    public function store(storeMessageRequest $request) {
        DB::beginTransaction();
        try {
            $conversationService=new ConversationService();
            $conversation=$conversationService->getConversationToStore( $request->conversation_id ,Auth::id() ,$request->user_id );
          

            $service= new StoreMessageService($request);
            $messageInfo=$service->storeMessage();


            $message=$conversationService->store_message_db($conversation->id,Auth::id() ,$messageInfo['message'],$messageInfo['attachment'] ,$request->post('type') );
          
            DB::commit();

            $message->load('user');
            $message->user->makeHidden(['email','email_verified_at','deviceToken','created_at','updated_at',]);
            $message->makeHidden(['updated_at','conversation_id']);

       
            $this->sendToPusher($message);

            $this->sendToFirebase($conversation->id, $conversation->lable, $request->type);
           
            return response([
            'obj_msg' => $message,
            'status' => 1 ,
        ]);
        }
        catch (Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
    private function sendToPusher($message) :void{
        $other_users= $message->conversation->partiscipants()->where('user_id','<>',Auth::id())->select('id')->get();
        foreach( $other_users as  $other_user)
        event(new MessageCreated($message ,$other_user->id));
        return ;

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
        $message->delete();
        return ' message deleted . . .';
    }
}
