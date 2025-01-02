<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'img',
        'deviceToken'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function conversation()
    {
        return $this->hasMany(Conversation::class)
        ->latest('last_message_id')
        ;
        // ->withPivot(['role','joined_at']);
         
    }
    

    public function sentMasseges()
    {
    return $this->hasMany(Message::class,'user_id','id');
    
    }

    
    public function receivedMasseges()
    {
    return $this->belongsToMany(Message::class,'resipients')
        ->withPivot(['read_at','deleted_at'])
        ;
    
    }

    public function partiscipants()
    {
    return $this->hasMany(Participant::class);
    }

    public function friend()
    {
        return $this->hasMany(Friend::class,'user1_id');
    }
    public function friend2()
    {
        return $this->hasMany(Friend::class,'user2_id');
    }
}
