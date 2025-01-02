<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'conversation_id' => 8,
            'user_id' =>1,
            'body' => `    <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;"><p>asd <span class="sended  fas fa-check" style="position:relative ;bottom:-12px;right:-10px;z-index:12;visibility:"></span> </p></div> `, // password
            'type' => 'text',
            
        ];
    }
}
