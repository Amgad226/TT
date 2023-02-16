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

class MessageCreatedInGroup implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels,Queueable;


    public  $other_user;
    public $message ;
    public function __construct($message, $other_user )
    {
        $this->message=$message ; 
        $this-> other_user=$other_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        
              return   new PrivateChannel('Messenger.'.$this->other_user->id);

        
       

    }
    public function broadcastAs(){
        return 'new-message';
    }

    public function broadcastWith () {
        return [
            'message'       =>$this->message
        ];
        // return $this->message;
    }
}
