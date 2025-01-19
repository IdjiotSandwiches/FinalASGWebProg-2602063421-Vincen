<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->interest = json_decode($user->interest);
        $user->interest = implode(', ', $user->interest);

        $friends = User::with(['friend'])->where('id', $user->id)
            ->first()
            ->friend;
        
        $f = Friend::where('friend_id', $user->id)->pluck('user_id');
        $f = $friends->whereIn('id', $f)->pluck('id');

        $friends = $friends->map(function ($q) use ($f) {
            $q->followed = in_array($q->id, $f->toArray());

            return $q;
        });

        return view('profile.index', compact('user', 'friends'));
    }
}
