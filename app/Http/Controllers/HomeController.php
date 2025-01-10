<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

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

        $posts = PostImage::with(['user:id,name,interest', 'user.friend:id,name'])
            ->when($user, function ($query) use ($user) {
                return $query->whereIn('theme', json_decode($user->interest));
            })
            ->select(['id','post_image_url','user_id'])
            ->paginate(10, ['id','post_image_url','user_id'])
            ->through(function ($post) {
                $friendIds = $post->user->friend->pluck('id');
                $post->notFriend = $post->whereIn('user_id', $friendIds)
                    ->get()
                    ->isEmpty();
                $post->interest = json_decode($post->user->interest);
                $post->interest = implode(', ', $post->interest);
                return $post;
            });
        dd($posts);

        return $posts;
    }
}
