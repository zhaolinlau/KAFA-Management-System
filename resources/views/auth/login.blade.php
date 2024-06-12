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

				<div class="card shadow-sm px-2 border-0">

					<div class="card-body">
						<form method="POST" action="{{ route('login') }}">
							@csrf

							<div class="mb-3">
								<label for="email" class="col-form-label">{{ __('Email') }}</label>

								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="mb-3">
								<label for="password" class="form-label">{{ __('Password') }}</label>

								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
									name="password" required autocomplete="current-password">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<div class="mb-3 row">
								<div class="col">
									<input class="form-check-input" type="checkbox" name="remember" id="remember"
										{{ old('remember') ? 'checked' : '' }}>

									<label class="form-check-label" for="remember">
										{{ __('Remember me') }}
									</label>
								</div>

								@if (Route::has('password.request'))
									<div class="col justify-content-end d-flex">
										<a class="link-primary" href="{{ route('password.request') }}">
											{{ __('Forgot password?') }}
										</a>
									</div>
								@endif
							</div>

							<div class="mb-0 text-end d-grid">
								<button type="submit" class="btn btn-primary">
									{{ __('LOG IN') }}
								</button>
							</div>
						</form>

						<div class="mt-3 text-center">
							Don't have an account yet? <a class="link-primary" href="{{ route('register') }}">Register</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
