<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resipient extends  Pivot
{
    use HasFactory,SoftDeletes;
    public $timestamps=false;
    protected $cast=[
        'read_at'=>'datetime',

    ];
    public function conversation()
    {
    return $this->belongsTo(Conversation::class);
    }
    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
