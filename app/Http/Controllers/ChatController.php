<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($id)
    {
        $chat = $this->receiveMessage($id);

        return view('chat.index', compact('chat', 'id'));
    }

    public function sendMessage(Request $request)
    {
        $chat = new Chat();
        $chat->user_id = Auth::user()->id;
        $chat->friend_id = $request->friend_id;
        $chat->message = $request->message;
        $chat->save();

        return back();
    }

    public function receiveMessage($id)
    {
        $chat = Chat::with('user')->whereIn('user_id', [Auth::user()->id, $id])
            ->whereIn('friend_id', [Auth::user()->id, $id])
            ->orderBy('created_at')
            ->get();
        
        return $chat;
    }
}
