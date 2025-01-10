<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function create($id)
    {
        $user = Auth::user();
        $friend = new Friend();
        $friend->user_id = $user->id;
        $friend->friend_id = $id;
        $friend->save();

        return back()->with([
            'status' => 'success',
            'message' => __('Friend added.'),
        ]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $friend = Friend::where('user_id', $user->id)
            ->where('friend_id', $id);
        $friend->delete();

        return back()->with([
            'status' => 'success',
            'message' => __('Friend removed.'),
        ]);
    }
}
