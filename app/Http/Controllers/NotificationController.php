<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
     public function getNotification()
    {
      
        $notifications= Notification::latest()->where('owner_id',Auth::id())->get();
        foreach($notifications as $notification){
           $user= User::find($notification->user_id);

           $notification['img']=$user->img;
        }
        return $notifications;
    }
}
