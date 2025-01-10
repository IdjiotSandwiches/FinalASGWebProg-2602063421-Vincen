@extends('layouts.app')
@section('title', 'Registration Payment')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Payment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('payment.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="registration_fee"
                                class="col-md-4 col-form-label text-md-end">{{ __('Registration Fee') }}</label>

                            <div class="col-md-6">
                                <input id="registration_fee" type="text" class="form-control" name="registration_fee"
                                    value="Rp {{ number_format($registrationFee, 0, ',', '.') }}" autofocus disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="balance" class="col-md-4 col-form-label text-md-end">{{ __('Balance') }}</label>

                            <div class="col-md-6">
                                <input id="balance" type="number"
                                    class="form-control @error('balance') is-invalid @enderror" name="balance"
                                    value="{{ old('balance') }}" required autocomplete="balance">

                                @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (\Illuminate\Support\Facades\Session::has('message'))
                            <input type="hidden" name="overpaid" value="1">
                            <div class="row mb-0">
                                <span class="col-md-8 offset-md-4 mb-2 text-danger">
                                    <strong>{{ \Illuminate\Support\Facades\Session::get('message') }}</strong>
                                </span>
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Yes') }}
                                    </button>
                                    <a href="{{ route('payment.index') }}" class="btn btn-danger">{{ __('No') }}</a>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="overpaid" value="0">
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Pay') }}
                                    </button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection