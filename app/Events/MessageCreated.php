<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MessageCreated implements ShouldBroadcast , ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels ,Queueable;


    public $message;
    public $type;
    public function __construct(Message $message , $type)
    {
        $this->message=$message;
        $this->type=$type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      
            $other_user=$this->message->conversation->partiscipants()->where('user_id','<>',Auth::id())->first();
            return new PrivateChannel('Messenger.'.$other_user->id);
            // return new PrivateChannel('Messenger.'.'2');
            
        

    }
    public function broadcastAs(){
        return 'new-message';
    }
    public function broadcastWith () {
        return [
            'message'       =>$this->message,
        ];
        // return $this->message;
    }
}
