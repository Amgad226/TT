<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $table = 'conversations';
public $timestamps=false;
    protected $fillable=[
        'user_id','lable' ,'type', 'last_message_id'
    ];
    public function partiscipants()
    {
        return $this->belongsToMany(User::class,'partiscipants')
          // ->withPivot(['role','joined_at'])
        ;
    }

    public function messages()
    {
    return $this->hasMany(Message::class,'conversation_id','id');
    // ->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function lastMassege()
    {
    return $this->belongsTo(Message::class,'last_message_id','id')
    ->withDefault();
    }


}
