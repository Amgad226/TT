<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Participant extends Pivot
{
    protected $table = 'partiscipants';
    
    use HasFactory;

    public $timestamps=false;
    protected $cast=[
        'joined_at'=>'datetime',
    ];
public $fillable=['conversation_id','user_id','role'];



    public function conversation()
    {
    return $this->belongsTo(Conversation::class,'conversation_id');
    }

    public function message()
    {
        return $this->hasMany(Message::class,'user_id','user_id');
    }
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
