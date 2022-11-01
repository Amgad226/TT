<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=
    [
        'conversation_id','user_id','body','type','to','attachment',
    ];
    protected $casts = [
        'attachment' => 'array',
    ];
    protected function createdAt(): Attribute
    {
       
        return Attribute::make(
            // get: fn ($value) =>$value->diffForHumans(),
            // set: fn ($value) =>$value->format('Y-m-d H:i:s'),
        );

        
        
       
 
    }
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
