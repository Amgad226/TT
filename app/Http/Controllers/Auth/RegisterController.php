<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Friend;
use App\Models\Participant;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        return view('auth.login');

    }
  

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'deviceToken' => ['required'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd( $data['img']);
        // $uniqid=uniqid();
        //  $link_attachment = $data['img']->move('img',$uniqid.'.'.$data['img']->getclientoriginalextension());

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'deviceToken'=>$data['deviceToken'],
            'img' =>'https://ui-avatars.com/api/?background=2787F5&color=fff&name='.$data['name']
            // 'img' =>$link_attachment,
        ]);
        $friend=Friend::create(['user1_id'=>1,'user2_id'=>$user->id,'acceptable'=>1]);
        $conversation = Conversation::create([
            'user_id' =>1,
            'type' => 'peer',
            'img'=>' '
        ]);
        $conversation->lable='peer';
        $conversation->save;
        
        // $conversation->partiscipants()->attach([Auth::id() ,$user_id]);
        Participant::create(['user_id' => 1, 'conversation_id' => $conversation->id,'joined_at'=>now()]);
        Participant::create(['user_id' =>$user->id , 'conversation_id' => $conversation->id ,'joined_at'=>now()]);
        return $user;
    }
}
