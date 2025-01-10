@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 border-end">
            <h3 class="fw-semibold">{{ $user->name }}</h3>
            <p>{{ $user->interest }}</p>
        </div>
        <div class="col-md-7">
            <h4 class="fw-semibold mb-2">{{ __('Friend List') }}</h4>
            @foreach ($friends as $friend)
                @include('component.__friend-card', ['friend' => $friend])
            @endforeach
        </div>
    </div>
</div>
@endsection