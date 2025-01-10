@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-md-6 col-lg-4">
            @if (Session::has('status'))
                <div class="alert alert-{{ Session::get('status') }}" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-header row justify-content-between m-0 p-2">
                        <div class="col-7 col-md-8">
                            <h5 class="fw-medium">{{ $post->user->name }}</h5>
                            {{ $post->interest }}
                        </div>
                        @if ($post->notFriend)
                            <form method="POST" action="{{ route('friend.create', $post->user_id) }}" class="col-5 col-md-4 row">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-primary h-75">{{ __('Follow') }} +</button>
                            </form>
                        @endif
                    </div>
                    <img src="{{ asset($post->post_image_url) }}" class="card-img-bottom w-100" alt="...">
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection