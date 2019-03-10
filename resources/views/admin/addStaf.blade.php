@extends('layouts.admin')

@section('content')
<a href="/kelola-staf"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>   List of Users</a>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-10">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="login100-form validate-form" action="{{ route('addStaf') }}" method="POST">
            					@csrf
            					<span class="login100-form-title">
            						<h3 style="    margin-top: 20px;">Add User</h3>
            					</span>


            					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            						<input id="name" type="text" class="input100 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="name" required autofocus>
            						@if ($errors->has('name'))
            								<span class="invalid-feedback" role="alert">
            										<strong>{{ $errors->first('name') }}</strong>
            								</span>
            						@endif
            						<span class="focus-input100"></span>
            					</div>
                      <br>


            					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            						<input id="email" type="email" class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>
            						@if ($errors->has('email'))
            								<span class="invalid-feedback" role="alert">
            										<strong>{{ $errors->first('email') }}</strong>
            								</span>
            						@endif
            						<span class="focus-input100"></span>
            					</div>
                      <br>

            					<div class="wrap-input100 validate-input" data-validate = "Password is required">
            						<input id="password" type="password" class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
            						@if ($errors->has('password'))
            								<span class="invalid-feedback" role="alert">
            										<strong>{{ $errors->first('password') }}</strong>
            								</span>
            						@endif
            						<span class="focus-input100"></span>
            					</div>
                      <br>


            					<div class="wrap-input100 validate-input" data-validate = "Password is required">
            						<input id="password-confirm" type="password" class="input100 form-control" name="password_confirmation" placeholder="confirm password" required>
            						<span class="focus-input100"></span>
            					</div>
                      <br>


            					<div class="container-login100-form-btn">
            						<button class="btn btn-primary">
            							{{ __('Create Account') }}
            						</button>
            					</div>


            				</form>
                </div>
        </div>
    </div>
</div>
@endsection
