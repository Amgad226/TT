<?php
namespace App\services;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Resipient;
use Illuminate\Support\Facades\DB;

class MessageConversationService{

    public $conversation;
    public $userId;
    public $limit;

    public function __construct(Conversation $conversation , $userId, $page){
        $this->conversation=$conversation;
        $this->userId=$userId;
        $this->limit=  config('global.number_of_message_to_read')  * $page;

    }

    public function index(){
        $this->makeMessagesRead();
        $this->loadPartiscipants();
        $allMessagesCount= $this->queryCount();
        $messages=$this->getMessages($allMessagesCount);
        $read_more=$this->stillMessages($allMessagesCount,$messages);
        $this ->makeHidden($messages);
        return [
          'conversation'=>  $this->conversation,
          'messages'=>  $messages,
          'read_more'=> (int) $read_more,
        ];
    }

    protected function makeHidden($messages){
        $this->conversation->partiscipants->makeHidden(['email','email_verified_at','deviceToken','created_at','updated_at']);
        // $messages->makeHidden(['updated_at']);
        // foreach($messages as $message){
        //     $message->user->makeHidden(['email_verified_at','deviceToken','created_at','updated_at']);
        // }
     

    }
    public function stillMessages($allMessagesCount,$messages):bool{
        return  $allMessagesCount > count($messages)  ?1  :0;
    }


    public  function loadPartiscipants():void{

        $this->conversation->load([
            'partiscipants'  => function ($query) {

                // $query->select();
                $query->where('id', '<>',$this->userId);
        }]);

    }
    public function queryCount():int
    {
        return  DB::table('messages')->where('deleted_at',null)->where('conversation_id', $this->conversation->id)->count();

    }
    public function getMessages($allMessagesCount){
              
        return Message::with(['user'=>function ($query){$query->select('id','name','img');}])
                      ->limit($this->limit)
                      ->skip($allMessagesCount  -($this->limit  ))
                      ->where('conversation_id', $this->conversation->id)
                      ->select('id','conversation_id','user_id','body','type','attachment','deleted_at','created_at')
                      ->get();     
    }
    

    public function makeMessagesRead():void{

        $a =DB::table('conversations')->select('messages.id')->
        join('messages','conversations.id','=','messages.conversation_id')->
        where('conversations.id',$this->conversation->id)->
        get()  ->map(function($e){
            return $e=$e->id;
        }) ;
        Resipient ::where('user_id',$this->userId)->whereIn('message_id',$a)->where('read_at',null)->update(['read_at'=>now()]);
    }

}
