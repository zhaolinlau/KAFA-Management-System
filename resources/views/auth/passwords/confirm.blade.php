@extends('layouts.app')

@section('content')
	<div class="container h-100 d-flex align-items-center justify-content-center">
		<div class="row justify-content-center w-100">
			<div class="col-md-4">
				<div class="card px-2 border-0 shadow-sm">

					<div class="card-body">
						<h5 class="card-title">{{ __('Confirm Password') }}</h5>

						<div class="card-text mb-3">
							{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
						</div>

						<form method="POST" action="{{ route('password.confirm') }}">
							@csrf

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

							<div class="mb-0 text-end">
								@if (Route::has('password.request'))
									<a class="btn btn-link" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
								@endif

								<button type="submit" class="btn btn-primary">
									{{ __('Confirm') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection