@props(['friend'])

<div class="card mb-3">
    <div class="card-body">
        <h5 class="fw-semibold">{{ $friend->name }}</h5>
        <p>{{ implode(', ', json_decode($friend->interest)) }}</p>
    </div>
</div>