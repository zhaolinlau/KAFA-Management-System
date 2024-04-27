@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-4">
        <div class="col-md-6">
            <div class="card px-2 border-0 shadow-sm">

                <div class="card-body">
                    <h5 class="card-title">{{ __('Verify Your Email Address') }}</h5>
                    <div class="card-text mb-3">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
                        we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </div>
                    @if (session('resent'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Resend Verification Email') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection