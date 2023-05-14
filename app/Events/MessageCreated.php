<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MessageCreated implements ShouldBroadcast , ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels ,Queueable;


    public $message;
    public $user_id;

    public function __construct(Message $message ,  $user_id)
    {
        $this->message=$message;

        $this->user_id=$user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      
       
            return new PrivateChannel('Messenger.'.$this->user_id);
            // return new PrivateChannel('Messenger.'.'2');
            
        

    }
    public function broadcastAs(){
        return 'new-message';
    }
    public function broadcastWith () {
        $this->message->makeHidden(['updated_at','deleted_at','']);
        $this->message->conversation->makeHidden(['user_id','img','description','partiscipants']);
        $this->message->user->makeHidden(['id','email','email_verified_at','deviceToken','created_at','updated_at']);
        // $this->message->makeVisible('')
        return [
            'message'=>$this->message
            
        ];
       
        // return $this->message;
    }
}
