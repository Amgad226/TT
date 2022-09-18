<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=
    [
        'conversation_id','user_id','body','type','to',
    ];
    public function conversation()
    {
    return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>__('User')
        ]);

    }
    public function resipients()
    {
        return $this->belongsToMany(User::class,'resipients')
        // ->withPivot(['read_at','deleted_at'])
        ;
        
    }
}
