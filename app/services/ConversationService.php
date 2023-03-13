<?php
namespace App\services;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Resipient;
use Illuminate\Support\Facades\DB;

class ConversationService{


    public function getConversationToStore( $conversation_id ,$userId ,$requestUserId ){

        // dd($receiver_user_img);
        if ($conversation_id) {
            $conversation= $this->search_for_conversation_by_conversationId($conversation_id);
        }
        else {
            $conversation_id=$this->search_for_conversationId_between_two_users($userId,$requestUserId);
            $conversation =($conversation_id!=null) ? Conversation::find($conversation_id) : false ;
        }
        if ($conversation==false) {
            $conversation = Conversation::create([
                'user_id' => $userId,
                'type' => 'peer',
                'img'=>'peer',
                'lable'=>'peer',
            ]);
            $conversation->partiscipants()->attach([$userId ,$requestUserId]);
            // Participant::create(['user_id' => Auth::id(), 'conversation_id' => $conversation->id]);
            // Participant::create(['user_id' => $user_id , 'conversation_id' => $conversation->id]);
        }
        return $conversation;

    }

    public function search_for_conversationId_between_two_users($userId,$requestUserId){


         /*
            اذا  ما باعتلي
            conversation_id
             ف انا رح دور ازا في محادثة موجودة بينني وبيين ال
            user_id
            يلي بعتلي ياه وازا في محادثة رح حطئ ال ايدي تبعها  ب
             $conversationn_id
             وجيب المحادثة
             والا رح حط فيها فولس
            */
        return  DB::table('conversations')->
        select('id')->
        join('partiscipants', 'conversations.id', '=', 'partiscipants.conversation_id')->
        join('partiscipants as par2', 'partiscipants.conversation_id', '=', 'par2.conversation_id')->
        where([['partiscipants.user_id', $userId],['conversations.type','peer'], ['par2.user_id', $requestUserId]])->
        orWhere([['partiscipants.user_id', $requestUserId],['conversations.type','peer'],  ['par2.user_id', $userId]])->
        pluck('id')->
        first();

    }

    public function search_for_conversation_by_conversationId($conversation_id){
        return Conversation::findOrFail($conversation_id);
    }

    public function store_message_db($conversation_id, $user_id, $msg, $type){
        $attachment='';
        // dd();
        $message =Message::create([
            'conversation_id' => $conversation_id,
            'user_id' => $user_id,
            'body' => $msg['message'],
            'type' => $type,
        ]);
     
        if($type=='attachment'){
            $attachment=$msg['attachment'];
            $message->update(['attachment'=> $attachment]);
        }

        // DB::statement(' INSERT INTO resipients (user_id,message_id) SELECT user_id ,? FROM partiscipants WHERE conversation_id=? ', [$message->id, $conversation_id]);
        DB::statement('INSERT INTO resipients (user_id, message_id) SELECT user_id, ? FROM partiscipants p WHERE conversation_id = ? AND NOT EXISTS ( SELECT 1 FROM resipients r WHERE r.user_id = p.user_id AND r.message_id = ?)', [$message->id, $conversation_id, $message->id]);
        // SQL statement will only insert new rows into the recipients table if there is no existing row with the same user_id and message_id values.

        Resipient::where('message_id',$message->id)->where('user_id',$user_id)->where('read_at',null)->update(['read_at'=>now()]);

        // $conversation->update(['last_message_id' => $message->id]);
        DB::table('conversations')->where('id',$conversation_id)->update(['last_message_id' => $message->id]);

        return [$message,$attachment];
    }
}
