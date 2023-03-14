<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return  DB::select( "SELECT users.id, users.img, users.name from users  WHERE users.id in (SELECT  CASE     WHEN user1_id = ? THEN user2_id     ELSE user1_id END AS friend_id FROM friends WHERE user1_id = ? OR user2_id = ? AND acceptable = true)" ,[Auth::id(),Auth::id(),Auth::id()]);       
    }
    public function search_friends(Request $request){

        return  DB::select( "SELECT users.id, users.img, users.name from users
                             WHERE name LIKE CONCAT('%', ?, '%') 
                              AND users.id in (SELECT  CASE     WHEN user1_id = ? THEN user2_id     ELSE user1_id END AS friend_id 
                              FROM friends
                               WHERE user1_id = ? OR
                                user2_id = ? AND 
                                acceptable = true)"
                                 ,[ $request->name,Auth::id(),Auth::id(),Auth::id()]); 

    }

  

    public function store(Request $request)
    {
        if($request->user_id==Auth::id())
        {
            return response()->json(['message '=>'send add to your self ','status'=>0],200);
        }
        $friend=Friend::where([['user1_id',$request->user_id],['user2_id',Auth::id()]])->
                        orWhere([['user1_id',Auth::id()],['user2_id',$request->user_id]])->
                        first();

        if($friend ==null )
        {
            
            $f= Friend::create(['user1_id'=>Auth::id(),'user2_id'=>$request->user_id]);
         
            Notification::create(['refernce'=>$f->id,'owner_id'=>$request->user_id , 'user_id'=>Auth::id(),'title'=>Auth::user()->name ,'body'=>'Send you a friend request.' ,'type'=>'request']);
            return response()->json([
                'id'=>$f->id,   
                'status'=>1,
                'message'=>'send add friend  successfuly'
            ],200);
        }
        return response()->json([  
            'status'=>0,
            'message'=>'allready send add friend successfuly'
        ],200);
        
    }

  

    public function update($frindship_id)
    {

        $friendship=Friend::find($frindship_id);
        if($friendship==null)
        return response()->json(['message'=>'not found','status'=>0],200);
        
        if($friendship->acceptable==1)
        return response()->json(['message'=>'alleady accepted','status'=>0],200);


        $friendship->update(['acceptable'=>1]);

        $notification= Notification::where('refernce',$frindship_id)->first();
        $notification->delete();

      
        return response()->json([
            'status'=>1,
            'message'=>'added successfuly'
        ],200);
    }


    public function destroy($frindship_id )
    {
        $friendship=Friend::find($frindship_id);
        if($friendship==null)
        return response()->json(['message'=>'not found','status'=>0],200);
        
        $friendship->delete();

        $notification= Notification::where('refernce',$frindship_id)->first();
        if($notification)
        $notification->delete();
        

        return response()->json([
            'status'=>1,
            'message'=>'delelte successfuly'
        ],200);
    }
    
}
