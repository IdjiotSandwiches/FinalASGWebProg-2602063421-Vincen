<?php

namespace App\Http\Controllers;

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

        return view('profile.index', compact('user', 'friends'));
    }
}
