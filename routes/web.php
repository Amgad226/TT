<?php

use App\Events\MessageCreated;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\PusherController;
use App\Models\Conversation;
use App\Models\Friend;
use App\Models\Message;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes(['register' => false]);











// Route::get('/a/{id?}',[MessengerController::class,'index'])->middleware('auth')->name('messenger');



Route::get('as',function(){
    return response()->json(['status'=>0,'message'=>'you shoud login']);
})->name('jsonResponse');


Route::view('/','messenger')->name('tt')->middleware('auth:sanctum');
// Route::view('aa','messenger_copy');
// Route::view('we','welcome');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::post('/broadcasting/auth', [PusherController::class, 'pusherAuth'])


Route::post('reg', function (Request $request)
{
    $deviceToken=$request->deviceToken;
    if($deviceToken==null){
        $deiviceToken='null';
    }
    
   $user= User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'deviceToken'=>$deviceToken,
        'img' =>'https://ui-avatars.com/api/?background=2787F5&color=fff&name='.$request->name
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

    // return redirect()->route('login');
    // return redirect('/login',302,['proxy_set_header'=>'X-Forwarded-Proto https'],true);

})->name('register1');

Route::view('register','auth.register')->name('register');
// Route::get('register', function (){
//     return redirect('/register');

// })->name('register');
