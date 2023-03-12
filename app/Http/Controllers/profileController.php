<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Storage;

class profileController extends Controller
{

    public function updateName(Request $request){
        Auth::user()->update(['name'=>$request->new_name]);
        return response()->json(['message'=>'name updated ', 'status'=>1]);

    }

    public function updateImg(Request $request)
    {
        $body=$request->file('img');
        $name=$body->getClientOriginalName();

        $image_resize = Image::make($body->getRealPath())->encode($body->getclientoriginalextension());;
        $image_resize->resize(1280, 720, function ($constraint) {$constraint->aspectRatio(); });


        $name=Auth::user()->name;
        $extension=$body->getclientoriginalextension();
        $uniqid=uniqid();



        Storage::disk('google')->put('userimage/'.$name.$uniqid.'.'.$extension ,$image_resize,  );
        $link_attachment = Storage::disk('google')->url('userimage/'.$name.$uniqid.'.'.$extension);

        // $image_resize->save(public_path('img/'.$name.$uniqid.'.'.$body->getclientoriginalextension()));
        // $link_attachment='img/'.$name.$uniqid.'.'.$body->getclientoriginalextension();

        Auth::user()->update(['img'=>$link_attachment]);
        return response()->json(['message'=>'image updated ', 'status'=>1]);


    }

    public function change_pass(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
            'verify_password' => 'required|same:new_password',


        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $key = 'message';
                $errors[$key] = is_array($value) ? implode(',', $value) : $value;
            }
            return response()->json(['message' => $errors['message'], 'status' => 0], 200);
        }

        $user = User::find(Auth::id());

        // Hash::c
        if ( Hash::check($request->get('current_password'), Auth::user()->password) )  {
            // $new_passwordword =
            $user->password =  Hash::make($request->new_password);
            $user->save();
            Notification::create(['owner_id' => Auth::id(), 'user_id' => Auth::id(), 'title' => 'Password Changed', 'body' => 'Your password has been updated successfully..', 'type' => 'password']);

            return response()->json(['status' => 1, 'message' => 'Changed successfully'], 200);
        }
        // if ( $request->get('current_password')== Auth::user()->password)   {
        //     // $new_password =
        //     $user->password = $request->new_pass;
        //     $user->save();
        //     Notification::create(['owner_id' => Auth::id(), 'user_id' => Auth::id(), 'title' => 'Password Changed', 'body' => 'Your password has been updated successfully..', 'type' => 'password']);

        //     return response()->json(['status' => 1, 'message' => 'Changed successfully'], 200);
        // }

        return response()->json(['status' => 0, 'message' => ' current password is wrong '], 200);
    }

    public function getUsers(){

        $friend_users= DB::table('friends')->where([['user1_id',Auth::id()],['acceptable',1]])->orWhere([['user2_id',Auth::id()],['acceptable',1]])->get(['id','user1_id','user2_id']);

        $ids=[];
            foreach($friend_users as $u )
            {
                if($u->user1_id != Auth::id())
                array_push($ids,$u->user1_id );
                else
                 array_push($ids,$u->user2_id );
            }

        $users = DB::table('users')->where('id','<>',Auth::id())->whereNotIn('id', $ids)->get();
        return $users;
    }

    public function search_users(Request $request)
    {
        $users = User::where('users.name', 'like', "%" . $request->name . "%")->where('id', '<>', Auth::id())->get();
        return $users;
    }

    public function getNotification()
    {

        $notifications= Notification::latest()->where('owner_id',Auth::id())->get();
        foreach($notifications as $notification){
           $user= User::find($notification->user_id);

           $notification['img']=$user->img;
        }
        return $notifications;
    }

    public function sendToFirebase(Request $r){
        $participants=Participant::where('conversation_id',$r->conversation_id)->where('user_id','<>',Auth::id())->get('user_id');
        $a=[];
        foreach($participants as $participant )
         {
             $firebaseToken = User::where('id',$participant->user_id)->pluck('deviceToken')->all();

             $SERVER_API_KEY = config('global.FIREBASE_SERVER_API_KEY');

             $data = [
                 "registration_ids" => $firebaseToken,
                 "notification" => [
                     "title" =>$r->title,
                     "body" => $r->body,
                     "content_available" => true,
                     "icon"=>asset('logo.png'),
                     "click_action"=>'/',
                     "priority" => "high",
                     // "vibrate"=> [200, 100, 200, 100, 200, 100, 200],
                     // "tag"=> 'vibration-sample'
                 ]
             ];
             $dataString = json_encode($data);

             $headers = [
                 'Authorization: key=' . $SERVER_API_KEY,
                 'Content-Type: application/json',
             ];

             $ch = curl_init();

             curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

             $response = curl_exec($ch);

             array_push($a,$response);
         }
        return $a;


    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email', 'exists:users:email',
            'password' => 'required',
        ]);


        $user = User::where('email', $request->email)->first();

        // dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return ['status' => 0, 'message' => 'Invalid Credentials', 'data' => []];
        }
        $data = [
            'user' => $user,
            'token' => $user->createToken('MyToken')->plainTextToken
        ];
        return $user->createToken('MyToken')->plainTextToken;
        return ['status' => 1, 'message' => 'Login Successful!', 'data' => $data];
    }

}
