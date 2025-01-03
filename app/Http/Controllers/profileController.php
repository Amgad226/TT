<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Notification;
use App\Models\User;
use App\services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class profileController extends Controller
{
    
    public function updateName(Request $request){
        $request->validate(["new_name"=>"required","string"]);
        Auth::user()->update(['name'=>$request->new_name]);
        return response()->json(['message'=>'name updated ', 'status'=>1]);

    }

    public function updateImg(Request $request){
        $link_attachment =ImageService::store($request->img, Auth::user()->name,'usersImages',false);

        Auth::user()->update(['img'=>$link_attachment]);

        return response()->json(['message'=>'image updated ', 'status'=>1]);
    }

    public function change_pass(ChangePassRequest $request){
        $user = User::find(Auth::id());

        if ( Hash::check($request->get('current_password'), Auth::user()->password) )  {

            $user->password =  Hash::make($request->new_password);
            $user->save();
            Notification::create(['owner_id' => Auth::id(), 'user_id' => Auth::id(), 'title' => 'Password Changed', 'body' => 'Your password has been updated successfully..', 'type' => 'password']);

            return response()->json(['status' => 1, 'message' => 'Changed successfully'], 200);
        }
    
        return response()->json(['status' => 0, 'message' => ' current password is wrong '], 200);
    }

    public function getUsers(){

        return  User::where('id', '<>', Auth::id())
                ->whereNotIn('id', function ($query) {
                    $query->selectRaw('CASE WHEN user1_id = ? THEN user2_id ELSE user1_id END', [Auth::id()])
                    ->from('friends')
                    ->where('user1_id', Auth::id())
                    ->orWhere('user2_id', Auth::id())
                    ->where('acceptable', true);
                })
        ->get();
    }

    public function search_users(Request $request){
        return User::where('users.name', 'like', "%" . $request->name . "%")->where('id', '<>', Auth::id())->get();
    }

    public function getNotification(){

       return DB::select('SELECT n.* , u.img FROM notifications as n
            JOIN users as u on u.id = n.user_id
            WHERE owner_id = ? 
            ORDER BY n.id desc',[Auth::id()]);
    }

    public function login(LoginRequest $request){

        $user = User::where('email', $request->email)->firstOrFail();

        if (  Hash::check($request->password, $user->password)) {
            
            return $user->createToken('MyToken')->plainTextToken;
        }
        return ['status' => 0, 'message' => 'Invalid Credentials'];
    }

    public function updateFirebaseToken(Request $request){
        User::find(Auth::id())->update(['deviceToken'=>$request->firebaseToken]);
        return true;
    }

    public function disableNoti(){
        User::find(Auth::id())->update(['deviceToken'=>'']);
        return true;
    }

}
