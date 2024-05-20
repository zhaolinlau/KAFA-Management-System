@extends('layouts.app')

@section('content')
	<div class="container h-100 d-flex align-items-center justify-content-center">
		<div class="row justify-content-center w-100">
			<div class="col-md-4">

				<div class="mb-3 text-center">
					<a href="{{ route('login') }}">
						<img class="rounded w-50" src="img/logo.png" alt="logo.png">
					</a>
				</div>

				<div class="card border-0 shadow-sm px-2">

					<div class="card-body">
						<div class="card-text mb-3">
							Forgot your password? No problem. Just let us know your email address and we will email you a password reset link
							that will allow you to choose a new one.
						</div>
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<form method="POST" action="{{ route('password.email') }}">
							@csrf

							<div class="mb-3">
								<label for="email" class="form-label">{{ __('Email') }}</label>

								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="mb-0 text-end">
								<button type="submit" class="btn btn-primary">
									{{ __('EMAIL PASSWORD RESET LINK') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
