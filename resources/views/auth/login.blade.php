@extends('auth.layout.header-auth')

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<span class="login100-form-title" style="margin-top: -120px;">
					DINAS PERDAGANGAN DAN PERINDUSTRIAN KABUPATEN BULELENG
				</span>
				<div class="login100-pic js-tilt" data-tilt>
					<a href="{{ url('/') }}"><img src="images/buleleng.png" alt="IMG"></a>
				</div>

				<form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
					@csrf
					<span class="login100-form-title">
						FORM LOGIN
					</span>

					@if(session('warning'))
					  <div class="alert alert-warning ">
					    {{session('warning')}}
					  </div>
					@endif

					@if(session('notif'))
					  <div class="alert alert-primary">
					    {{session('notif')}}
					  </div>
					@endif


					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input id="email" type="email" class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
						@if ($errors->has('email'))
								<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
								</span>
						@endif
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input id="password" type="password" class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
						@if ($errors->has('password'))
								<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
								</span>
						@endif
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>


					<div class="form-check">
							<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

							<label class="form-check-label" for="remember">
									{{ __('Remember Me') }}
							</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							{{ __('Login') }}
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Lupa
						</span>

						@if (Route::has('password.request'))
								<a class="txt2 btn btn-link" href="{{ route('password.request') }}">
										{{ __('Password?') }}
								</a>
						@endif

					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="/register">
							Daftar IKM Baru
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


@extends('auth.layout.footer-auth')
