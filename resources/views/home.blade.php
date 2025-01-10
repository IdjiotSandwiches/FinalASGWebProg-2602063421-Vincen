@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-md-6 col-lg-4">
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-header row justify-content-between m-0 p-2">
                        <div class="col-8">
                            <h5 class="fw-medium">{{ $post->user->name }}</h5>
                            {{ $post->interest }}
                        </div>
                        @if ($post->friend)
                            <a href="" class="col-4 col-md-3 btn btn-primary h-100">{{ __('Follow') }} +</a>
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