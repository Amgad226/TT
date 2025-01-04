<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddParticipantsRequest;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UserIdRequest;
use App\Models\Conversation;
use App\Models\Participant;
use App\services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConvarsationController extends Controller
{
    public function index()
    {

        return Conversation::with([
            'partiscipants' => function ($query) {
                $query->select('id', 'name', 'img');
            },
            'lastMassege' => function ($query) {
                $query->select('id', 'body', 'type', 'created_at',);
            }
        ])
            ->select('id', 'lable', 'img', 'type', 'description', 'last_message_id')
            ->join('partiscipants', 'conversations.id', '=', 'partiscipants.conversation_id')
            ->where('partiscipants.user_id', Auth::id())
            ->orderBy('conversations.last_message_id', 'desc')
            ->selectRaw('(SELECT COUNT(*) FROM messages 
        JOIN resipients ON messages.id = resipients.message_id
        WHERE messages.conversation_id = conversations.id AND 
        resipients.read_at IS NULL 
        AND resipients.user_id = ?) 
        AS unRead_message', [Auth::id()])
            ->get();
    }
    public function createGroup(CreateGroupRequest $request)
    {

        $groupName = ($request->groupName != null) ? $request->groupName : 'group';

        if ($request->hasFile('img')) {
            $imgToDB = ImageService::store($request->img, $groupName, '/img/group');
        }

        $group = Conversation::create([
            'user_id',
            Auth::id(),
            'lable' => $request->groupName,
            'description' => $request->groupDescription,
            'img' => $imgToDB,
            'type' => 'group',
        ]);

        $users_id = explode(",", $request->users_id);

        $participants = [];
        foreach ($users_id as $user_id) {
            $participants[] = ['conversation_id' => $group->id, 'user_id' => $user_id,];
        }

        Participant::insert($participants);

        Participant::create(['user_id' => Auth::id(), 'conversation_id' => $group->id, 'role' => 'admin']);

        return response()->json(['message' => 'group created successfuly', 'status' => 1], 200);
    }

    public function users_not_in_group($id)
    {

        return DB::table('users')
            ->select('name', 'id', 'img')
            ->whereIn('id', function ($query) {
                $query->selectRaw('CASE WHEN user1_id = ? THEN user2_id ELSE user1_id END AS friend_id', [Auth::id()])
                    ->from('friends')
                    ->where('user1_id', Auth::id())
                    ->orWhere('user2_id', Auth::id())
                    ->where('acceptable', 1);
            })
            ->whereNotIn('id', function ($query) use ($id) {
                $query->select('user_id')
                    ->from('partiscipants')
                    ->where('conversation_id', $id);
            })
            ->get();
    }

    public function getParticipants($id)
    {

        $participant = Participant::with(['user' => function ($query1) {
            $query1->groupBy('id');
            $query1->select('id', 'name', 'img');
        }])
            ->withCount(['message' => function ($query2) use ($id) {
                $query2->where('conversation_id', $id);
            }])
            ->where('conversation_id', $id)->get();

        $participant->makeHidden(['conversation_id', 'user_id']);
        return $participant;
    }

    public function addParticipants(AddParticipantsRequest $request)
    {

        $users_id = explode(",", $request->users_id);

        $participants = [];
        foreach ($users_id as $user_id) {
            $participants[] = ['conversation_id' => $request->conversation_id, 'user_id' => $user_id, 'joined_at' => Carbon::now()];
        }

        Participant::insert($participants);

        return response()->json(['status' => 1, 'message' => 'done']);
    }


    public function removeParticipant(UserIdRequest $request, Conversation $conversation)
    {

        $conversation->partiscipants()->detach($request->validated());

        return response()->json(['status' => 1, 'message' => 'done']);
    }


    public function search_chat(Request $request)
    {
        return  DB::table('partiscipants')->select('conversations.id as conversation_id', 'conversations.img', 'messages.type as lastMessageType', 'messages.body', 'users.name', 'messages.created_at')
            ->join('partiscipants as par2', 'partiscipants.conversation_id', '=', 'par2.conversation_id')
            ->join('users', 'users.id', '=', 'par2.user_id')
            ->join('conversations', 'conversations.id', '=', 'partiscipants.conversation_id')
            ->join('messages', 'messages.id', '=', 'conversations.last_message_id')
            ->where('partiscipants.user_id', '<>', 'par2.user_id')
            ->where('partiscipants.user_id', '=', Auth::id())
            ->where('par2.user_id', '<>', Auth::id())
            ->where('users.name', 'like', "%" . $request->name . "%")
            ->get();
    }
}
