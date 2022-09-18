<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // $friend_users=User::with('friend')->find(Auth::id());
        $friend_users=Auth::user()->friend()->with('user2')->where('acceptable',1)->get() ;
        $friend_users = $friend_users->map(function ($query) {
           return $query->user2;
         });
        return response()->json($friend_users);
    }

    // public function getfriends(){
        
    //     $friends=Friend::where('user1_id',Auth::id())->where('acceptable',1)->get();
    //     return $friends;

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $friend=Friend::where('user1_id',Auth::id())->where('user2_id',$request->user_id)->first() ;
    //  return $friend ; 
        if($friend ==null )
        {
            $user=User::find($request->user_id);
            $f= Friend::create(['user1_id'=>Auth::id(),'user2_id'=>$request->user_id]);
            $f= Friend::create(['user1_id'=>$request->user_id,'user2_id'=>Auth::id()]);
            Notification::create(['refernce'=>$f->id,'owner_id'=>$request->user_id , 'user_id'=>Auth::id(),'title'=>Auth::user()->name ,'body'=>'Send you a friend request.' ,'type'=>'request']);
            return response()->json([
                'id'=>$f->id,   
                'status'=>1,
                'message'=>'send add friend  successfuly'
            ],200);
        }
        return response()->json([
            // 'id'=>$f->id,   
            'status'=>0,
            'message'=>'allready send add friend successfuly'
        ],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$frindship_id)
    {
        // return'  '.$frindship_id;

        $friendship=Friend::find($frindship_id);
        // return $friendship;
        $fr= Friend::where('user1_id',$friendship->user2_id)->where('user2_id',$friendship->user1_id)->first();
        $notification= Notification::find($request->notification_id);

        $notification->delete();
        $friendship->update(['acceptable'=>1]);
        $fr->update(['acceptable'=>1]);
        return response()->json([
            'status'=>1,
            'message'=>'added successfuly'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($frindship_id , Request $request)
    {
        $friendship=Friend::find($frindship_id);

        // return($request->notification_id).'1';
        $notification= Notification::find($request->notification_id);
        $fr= Friend::where('user1_id',$friendship->user2_id)->where('user2_id',$friendship->user1_id)->first();

        $notification->delete();
        $friendship->delete();
        $fr->delete();

        return response()->json([
            'status'=>1,
            'message'=>'delelte successfuly'
        ],200);
    }
    
}
