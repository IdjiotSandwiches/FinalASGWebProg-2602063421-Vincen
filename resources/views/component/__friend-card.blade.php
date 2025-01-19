@props(['friend'])

<div class="card mb-3">
    <form method="POST" action="{{ route('friend.delete', $friend->id) }}" class="card-body row justify-content-between">
        @csrf
        @method('DELETE')
        <div class="col-8">
            <h5 class="fw-semibold">{{ $friend->name }}</h5>
            <p>{{ implode(', ', json_decode($friend->interest)) }}</p>
        </div>
        @if ($friend->followed)
            <a class="btn btn-primary h-100">{{ __('Message') }}</a>
        @endif
        <button type="submit" class="btn btn-danger h-100">{{ __('Remove') }}</button>
    </form>
</div>