@extends('layouts.app')
@section('title', 'Chat')

@section('content')
    <div>
        @foreach ($chat as $c)
            <p>{{ $c->user->name }}</p>
            <p>{{ $c->message }}</p>
            <p>{{ $c->created_at }}</p>
        @endforeach
    </div>

    <form action="{{ route('chat.send') }}" method="POST">
        @csrf
        @method('POST')

        <input type="hidden" name="friend_id" value="{{ $id }}">

        <div class="d-flex">
            <input type="text" name="message" id="message">
            <button type="submit">></button>
        </div>
    </form>
@endsection