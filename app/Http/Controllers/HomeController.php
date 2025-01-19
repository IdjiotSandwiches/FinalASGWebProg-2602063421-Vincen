<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = $this->getPostImage();
        return view('home', compact('posts'));
    }

    public function getPostImage()
    {
        $user = Auth::user();
        $friendIds = [];
        if ($user) {
            $user = User::with('friend')->find($user->id);
            $friendIds = $user->friend->pluck('id')->toArray();
            $friendIds[]  = $user->id;
        }

        $posts = PostImage::with(['user.friend'])
            ->when($user, function ($query) use ($user) {
                return $query->whereIn('theme', json_decode($user->interest));
            })
            ->paginate(10)
            ->through(function ($post) use ($friendIds, $user) {
                $post->notFriend = $user ? !in_array($post->user_id, $friendIds) : null;
                $post->interest = json_decode($post->user->interest);
                $post->interest = implode(', ', $post->interest);
                return $post;
            });

        return $posts;
    }
}
