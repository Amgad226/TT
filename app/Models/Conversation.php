<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;
    protected $table = 'conversations';
public $timestamps=false;
    protected $fillable=[
        'user_id','lable' ,'type','img', 'last_message_id','description'
    ];
    
    protected function img(): Attribute
    {
        if($this->type!='group')
        {
        return Attribute::make(
            get: fn ($value) =>$this->partiscipants->where('id','<>',Auth::id())->first()->img,
        );
        }
        else
        {
        return Attribute::make(
            get: fn ($value) =>$value,
        );

        }
        
       
 
    }

     public function namee()
    {
       return $this->partiscipants->where('id','<>',Auth::id())->first()->name;
    }

    protected function lable(): Attribute
    {
        if($this->type!='group')
        {
        return Attribute::make(
            get: fn ($value) =>$this->partiscipants->where('id','<>',Auth::id())->first()->name,
        );
        }
        else
        {
        return Attribute::make(
            get: fn ($value) =>$value,
        );

        }
    }    
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
